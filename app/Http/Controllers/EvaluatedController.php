<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Evuluated;
use App\Models\EvaluadetType;
use App\Models\EvaluatedNote;
use App\Models\DisciplineLevel;
use App\Exports\EvaluatedExport;
use App\Imports\EvaluatedImport;
use App\Models\CuttingSchoolYear;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\EvaluatedNoteEvent;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EvaluatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.evaluated.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function dataTable(){
        $query = Classe::where('status', '1')->orderBy('level_id');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('inscrit', function ($row) {
            return $row->inscrit <= 9 ? '0'.$row->inscrit : $row->inscrit;
        })
        ->addColumn('action', function ($data) {
            return ('<div class="my-0 order-actions d-flex justify-content-center">
                <button data-id="'.$data->id.'" class="btn btn-outline-light py-0 px-1 addEvaluated"><i class="bx bx-grid-small font-20 mx-0"></i></button>
            </div>');
        })
        ->rawColumns(['counter', 'inscrit', 'action'])
        ->make(true);
    }


    public function search(Request $request){
        try{
            $class = Classe::find($request['id']);
            $data = $this->getMatters($class['level_id']);
            return Response()->json([
                'status' => count($data) ? 200:201,
                'data' => count($data) ? $data:null
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $val = $request->validate([
                'classe' => 'required|integer',
                'matter' => 'required|integer',
                'cutting' => 'required|integer',
                'type' => 'required|string',
                'values' => 'required|string',
                'date' => 'required|date',
            ]);
            $verify = $this->verifyEvaluated($val['classe'], $val['matter'], $val['cutting'], $val['type'], $val['values'], $val['date']);
            if(!$verify){
                $evaluated = Evuluated::create([
                    'value' => $val['values'],
                    'created' => $val['date'],
                    'classe_id'  => $val['classe'],
                    'evaluadet_type_id' => $val['type'],
                    'discipline_level_id'=> $val['matter'],
                    'cutting_school_year_id' => $val['cutting']
                ]);
                return to_route('evaluated.note', $evaluated['id'])->with([
                    'msg' => 'Ajoutez les notes'
                ]);
            }
            else{
                return to_route('evaluated.back', $val['classe'].'_'.$val['matter'])->with([
                    'str' => 'warning',
                    'msg' => 'Evaluation déjà créée.'
                ]);
            }
        }
        catch (\Exception $e) {
            return to_route('evaluated.back', $request['classe'].'_'.$request['matter'])->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function addNote(string $str){
        try{
            $evaluated = Evuluated::find($str);
            $datas = $this->getStudent($evaluated->classe_id);
            return view('pages.evaluated.create',[
                'evaluated' => $evaluated,
                'students' => $datas,
            ]);
        }
        catch (\Exception $e) {
            return to_route('evaluated.back','5_2')->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $val = $request->validate([
                'evaluated' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'note' => 'required|array',
                'note.*' => 'nullable|string',
            ]); 
            $count = EvaluatedNote::where('evuluated_id', $val['evaluated'])->count();
            if(!$count){
                $i = 0;
                while($i < sizeof($val['student'])){
                    $count = EvaluatedNote::where('inscriptif_id', $val['student'][$i])->where('evuluated_id', $val['evaluated'])->count();
                    if(!$count){
                        $valeur = blank($val['note'][$i]) ? 'nc':$this->valNote($val['note'][$i]);
                        event(new EvaluatedNoteEvent($val['student'][$i], $val['evaluated'], $valeur)); // Déclenchement d'événement
                    }
                    $i++;
                }
                $str = 'success'; $msg = 'Notes ajoutée avec success !';
            }
            else{
                $str = 'danger'; $msg = 'Erreur, tentative de duplicaation !';
            }
            return to_route('evaluated.list', $val['evaluated'])->with([
                'str' => $str, 
                'msg' => $msg
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $val = $request->validate([
                'classId' => 'required|string',
                'matterId' => 'required|string',
            ]);
            $class = Classe::find($val['classId']);
            $matter = DisciplineLevel::find($val['matterId']);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'data' => $this->getEvaluated($class, $matter->id),
                'typeEvaluated' => $this->gettypeEvaluated()
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function export(string $id){
        try{
            $eval = Evuluated::find($id);
            $str = Str::upper(Str::random(2));
            $name = 'add_not_'.$str.'_'.$eval->classe->libelle.'_'.$eval->disciplineLevel->discipline->abbreviat.'_'.$id;
            return Excel::download(new EvaluatedExport($id), $name.'.xlsx');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function import(Request $request){
        try{
            $request->validate([
                'evaluated' => 'required|string',
                'fichier' => 'required|mimes:xlsx,xls|max:2048'
            ]);

            $file_name = $request->file('fichier')->getClientOriginalName();
            list($partie1, $partie2) = explode(".", $file_name, 2);
            list($add, $not, $str, $lib, $matter, $id) = explode("_", $partie1, 6);
            if(!($request['evaluated'] == $id)){
                return back()->with([
                    'str' => 'danger',
                    'msg' => 'Erreur d\'incompatibilité avec ce fichier !'
                ]);
            }
            $verify = EvaluatedNote::where('evuluated_id', $request['evaluated'])->count();
            if(!$verify){
                Excel::import(new EvaluatedImport($request['evaluated']), $request->file('fichier'));
                return to_route('evaluated.list', $request['evaluated'])->with([
                 'str' => 'success', 
                 'msg' => 'Fichier importé avec succès !'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Les notes ont été déjà importé.'
                ]);
            }
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function back(string $str){
        try{
            $explod = explode('_', $str);
            $class = Classe::find($explod[0]);
            $matter = DisciplineLevel::find($explod[1]);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'data' => $this->getEvaluated($class, $matter->id),
                'typeEvaluated' => $this->gettypeEvaluated()
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function getNote($str){
        try{
            $evaluated = Evuluated::find($str);
            $datas = $this->getNotStudentEndMatter($str);
            return view('pages.evaluated.liste',[
                'evaluated' => $evaluated,
                'students' => $datas,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $val = $request->validate([
                'evaluated' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'note' => 'required|array',
                'note.*' => 'nullable|string',
            ]); 
            $i = 0;
            while($i < sizeof($val['student'])){
                $count = EvaluatedNote::where('inscriptif_id', $val['student'][$i])->where('evuluated_id', $val['evaluated'])->first();
                if($count){
                    $count->update([
                        'valeur' => blank($val['note'][$i]) ? 'nc':$this->valNote($val['note'][$i])
                    ]);
                }
                $i++;
            }
            return to_route('evaluated.list', $val['evaluated'])->with([
                'str' => 'info', 
                'msg' => 'Mise à jour éffectuée !'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function delete(Request $request){
        try{
            $dts = Evuluated::find($request['id']);
            $data = $dts ? [
                'libelle' => ucwords($dts->evaluadet_type->libelle),
                'values' => $dts->value*20,
                'created' => date('d-m-Y', strtotime($dts->created)),
                'id' => $dts->id
            ]:null;
            return response()->json($data);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function overView(Request $request){
        try{
            $val = $request->validate([
                'cutting' => 'required|string',
                'class' => 'required|string',
                'matter' => 'required|string'
            ]);
            $class = Classe::find($val['class']);
            $matter = DisciplineLevel::find($val['matter']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            $evaluated = Evuluated::where('cutting_school_year_id', $cutting['id'])->where('classe_id', $class['id'])->orderBy('created')->get();
            return view('pages.evaluated.resultat',[
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting,
                'evaluated' => $evaluated,
                'datas' => $this->getNotStudent($class['id'], $evaluated)
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'.$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $val = $request->validate([
                'id' => 'required|string'
            ]);
            $dts = Evuluated::find($val['id']);
            if($dts){
                $dts->delete();
            }
            return to_route('evaluated.back',$dts->classe_id.'_'.$dts->discipline_level_id )->with([
                'str' => 'info',
                'msg' => 'Suppression effectuée.'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    private function getEvaluated($class, $matter){
        $data = CuttingSchoolYear::where('school_year_id', $class['school_year_id'])->get();
        $vals = ['successhome', 'successprofile', 'successcontact'];
        $table = []; $i = 0;
        foreach($data as $item){
            $table[] = [
                'id' => $item->id,
                'idTable' => $vals[$i],
                'status' => $item->status,
                'libelle' => $item->cutting->libelle,
                'evaluated' => Evuluated::where('discipline_level_id', $matter)->where('cutting_school_year_id', $item->id)->orderBy('created')->get()
            ];
            $i++;
        }
        return $table;
    }


    private function getNotStudent($class, $evaluated){
        $student = $this->getStudent($class);
        $table = [];
        foreach($student as $item){
            $table[] = [
                'id' => $item->id,
                'name' => strtoupper($item->first_name).' '.ucwords($item->last_name),
                'matricule' => $item->matricule,
                'genre' => ucwords($item->genre),
                'notes' => $this->getNotStudentMatte($item->id, $evaluated),
                'resultat' => []
            ];
        }

        return $table;
    }


    private function getNotStudentMatte($student, $evaluated){
        $note = [];
        foreach($evaluated as $item){
            $note[] = EvaluatedNote::where('inscriptif_id', $student)->where('evuluated_id', $item['id'])->first();
        }
        return $note;
    }

    private function verifyEvaluated($classe, $matter, $cutting, $type, $value, $created){
        $count = Evuluated::where('classe_id', $classe)
        ->where('value', '=', $value)
        ->where('created', '=', $created)
        ->where('evaluadet_type_id', $type)
        ->where('discipline_level_id', $matter)
        ->where('cutting_school_year_id', $cutting)
        ->count();
        return $count;
    }

    private function getStudent($class){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', '=', $class)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }

    private function getMatters($level){
        $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat')
        ->where('discipline_levels.level_id', '=', $level)
        ->orderBy('disciplines.libelle')->get();
        return $data ?? null;
    }

    private function getNotStudentEndMatter($evaluated){
        $data = DB::table('evaluated_notes')
        ->join('evuluateds', 'evuluateds.id', '=', 'evaluated_notes.evuluated_id')
        ->join('inscriptifs', 'inscriptifs.id', '=', 'evaluated_notes.inscriptif_id')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id', 'evuluateds.value', 'evaluated_notes.valeur')
        ->where('evuluateds.id', '=', $evaluated)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }

    private function valNote($val){
        // $note = $val ? str_replace(' ', '', $val):null;
        return match(true){
            strlen((string)$val) == 1 => '0'.$val,
            default => $val
        };
    }

    private function gettypeEvaluated(){
        $dts = EvaluadetType::orderBy('id')->get();
        return $dts;
    }
}
