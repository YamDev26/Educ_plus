<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classe;
use App\Models\Approved;
use App\Models\SubMatter;
use App\Models\Evuluated;
use App\Models\SchoolYear;
use App\Models\ClasseUser;
use App\Models\EvaluadetType;
use App\Models\EvaluatedNote;
use App\Models\MatterMoyenne;
use App\Models\DisciplineLevel;
use App\Models\SubMatterMoyenne;
use App\Exports\EvaluatedExport;
use App\Imports\EvaluatedImport;
use App\Models\CuttingSchoolYear;
use App\Jobs\CalculMoyenneClasseMatter;
use App\Jobs\MatterMoyenneJob;
use App\Jobs\SubMatterMoyenneJob;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\EvaluatedNoteEvent;
use App\Events\EditMoyenneEvent;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class EvaluatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if (session()->has('lv2')) {
                session()->forget('lv2'); // Supprimer la variable lv2 dans session
            }
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
        $query = Classe::where('school_year_id', $this->year())->where('status', '1')->orderBy('level_id');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('inscrit', function ($row) {
            return $row->inscrit < 9 ? '0'.$row->inscrit : $row->inscrit;
        })
        ->addColumn('action', function ($data) {
            return ('<div class="pt-1 d-flex justify-content-center">
                <button data-id="'.$data->id.'" data-lib="'.$data->libelle.'" class="btn btn-outline-light py-0 px-1 addEvaluated" style="border: none; border-radius: 3px">
                <i class="fadeIn animated bx bx-slider m-0" style="font-size: 17px"></i>
                </button>
            </div>');
        })
        ->rawColumns(['counter', 'inscrit', 'action'])
        ->make(true);
    }


    public function search(Request $request){
        try{
            $class = Classe::find($request['id']);
            $autre = $class['autre'] ? ($class['autre'] == 'musique' ? 'Mus':'AP'):null;
            $data = $this->getMatters($class['level_id'], $class['serie_id'], $autre, $class['lv2']);
            if($class['lv2'] == 'mixte'){
                $matter = $this->addLv2Mixte($class['level_id'], $class['serie_id']);
                $data = collect(array_merge($data, $matter))->sortBy('abbreviat')->values();
            }
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
            $exist = $this->getConfirm($val['classe'], $val['matter'], $val['cutting']);
            if(!$exist){
                $verify = $this->verifyEvaluated($val['classe'], $val['matter'], $val['cutting'], $val['type'], $val['values'], $val['date']);
                if(!$verify){
                    $evaluated = Evuluated::create([
                        'value' => $val['values'],
                        'created' => $val['date'],
                        'classe_id'  => $val['classe'],
                        'sub_matter_id' => $request['sub'],
                        'evaluadet_type_id' => $val['type'],
                        'discipline_level_id'=> $val['matter'],
                        'cutting_school_year_id' => $val['cutting']
                    ]);
                    return to_route('evaluated.note', $evaluated['id'])->with([
                        'msg' => 'Ajoutez les notes'
                    ]);
                } else{
                    $str = 'warning'; $msg = 'Evaluation déjà créée.';
                }
            } else{
                $str = 'warning'; $msg = 'Action inachevée, moyenne déjà confirmée !';
            }
            return to_route('evaluated.back', $val['classe'].'_'.$val['matter'])->with([
                'str' => $str,
                'msg' => $msg
            ]);
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
            // Déclenchement de Jobs Pour Calcul De Moyenne
            $evaluated = Evuluated::find($val['evaluated']);
            $evaluated['sub_matter_id'] ?
            SubMatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['sub_matter_id'], $evaluated['cutting_school_year_id'], $evaluated['discipline_level_id']):
            MatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
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
            list($id, $str) = explode('_', $val['matterId']);
            $class = Classe::find($val['classId']); 
            $matter = DisciplineLevel::find($id);
            getClasseMixte($str) ? session(['lv2' => getClasseMixte($str)]):null;
            if(!$class['serie_id']){
                $subMatter = $matter->discipline->libelle == 'Français' ? SubMatter::get():null;
            }
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => $subMatter ?? null,
                'data' => $this->getEvaluated($class, $matter->id),
                'typeEvaluated' => $this->gettypeEvaluated(),
                'enseignant' => $this->enseignant($val['classId'], $id)
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

                // Déclenchement de Jobs Pour Calcul De Moyenne
                $evaluated = Evuluated::find($request['evaluated']);
                $evaluated['sub_matter_id'] ?
                SubMatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['sub_matter_id'], $evaluated['cutting_school_year_id'], $evaluated['discipline_level_id']):
                MatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
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
            if(!$class['serie_id']){
                $subMatter = $matter->discipline->libelle == 'Français' ? SubMatter::get():null;
            }
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => $subMatter ?? null,
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
            $cutting = CuttingSchoolYear::find($evaluated->cutting_school_year_id);
            $exist = $this->getConfirm($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
            return view('pages.evaluated.liste',[
                'students' => $datas,
                'evaluated' => $evaluated,
                'status' =>  ($exist || $cutting->status == 2) ? false:true
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function geerateNotPdf($str){
        try{
            $evaluated = Evuluated::find($str);
            $enseignant = $this->enseignant($evaluated['classe_id'], $evaluated['discipline_level_id']);
            $datas = $this->getNotStudentEndMatter($str);
            $char = Str::upper(Str::random(2));
            $pdf = PDF::loadView('pages.evaluated.pdf.list_not',[
                'evaluated' => $evaluated,
                'students' => $datas,
                'enseignant' => $enseignant,
                'school' => School::first()
            ]);
            $pdf->setPaper('A4', 'portrait'); // ou 'A4', 'A3', etc.
            return $pdf->stream('Liste_note_'.$evaluated->classe->libelle.'_'.$char.'.pdf');
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
    public function edit(string $str)
    {
        try{
            list($class, $matter, $cutting) = explode("_", $str, 3);
            $classe = Classe::find($class);
            $matters = DisciplineLevel::find($matter);
            $cuttings = CuttingSchoolYear::find($cutting);
            $data = $this->getMoyenneStudent($class, $matter, $cutting);
            return view('pages.evaluated.edit',[
                'data' => $data,
                'classe' => $classe,
                'matter' => $matters,
                'cutting' => $cuttings
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function moyenEdit(Request $request){
        try{
            $val = $request->validate([
                'str' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'moyen' => 'required|array',
                'moyen.*' => 'nullable|string',
            ]);
            list($class, $matter, $cutting) = explode("_", $val['str'], 3);
            event(new EditMoyenneEvent($val['student'], $val['moyen'], $matter, $cutting)); // Déclenchement d'événement
            return to_route('evaluated.return', $class.'_'.$matter.'_'.$cutting)->with([
                'str' => 'info', 
                'msg' => 'Modification prise en compte avec success !'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function configMoyen(Request $request){
        try{
            list($class, $matter, $cutting) = explode("_", $request['str'], 3);
            $exist = $this->getConfirm($class, $matter, $cutting);
            if(!$exist){
                Approved::create([
                    'classe_id' => $class,
                    'discipline_level_id' => $matter,
                    'cutting_school_year_id' => $cutting
                ]);
            }
            // Déclenchement de job pour le calcul de moyenne
            CalculMoyenneClasseMatter::dispatch($class, $matter, $cutting);
            return to_route('evaluated.return', $request['str'])->with([
                'str' => 'info',
                'msg' => 'Moyennes conrfirmées avec succes !'
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

            // Déclenchement de Jobs Pour Calcul De Moyenne
            $evaluated = Evuluated::find($val['evaluated']);
            $evaluated['sub_matter_id'] ?
            SubMatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['sub_matter_id'], $evaluated['cutting_school_year_id'], $evaluated['discipline_level_id']):
            MatterMoyenneJob::dispatch($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
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
            $verify = verifyMatterCycle($class, $matter);
            $evaluated = $verify ? []:Evuluated::where('cutting_school_year_id', $cutting['id'])->where('classe_id', $class['id'])->where('discipline_level_id', $matter['id'])->orderBy('created')->get();
            $exist = $this->getConfirm($val['class'], $val['matter'], $val['cutting']);
            return view('pages.evaluated.resultat',[
                'exist' => $exist,
                'verify' => $verify,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting,
                'evaluated' => $evaluated,
                'datas' => $this->getNotStudent($class['id'], $evaluated, $val['matter'], $val['cutting'], $verify)
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function overReturn($str){
        try{
            list($str1, $str2, $str3) = explode("_", $str, 3);
            $class = Classe::find($str1);
            $matter = DisciplineLevel::find($str2);
            $cutting = CuttingSchoolYear::find($str3);
            $verify = verifyMatterCycle($class, $matter);
            $evaluated = $verify ? []:Evuluated::where('cutting_school_year_id', $str3)->where('classe_id', $str1)->where('discipline_level_id', $str2)->orderBy('created')->get();
            $exist = $this->getConfirm($str1, $str2, $str3);
            return view('pages.evaluated.resultat',[
                'exist' => $exist,
                'classe' => $class,
                'verify' => $verify,
                'matter' => $matter,
                'cutting' => $cutting,
                'evaluated' => $evaluated,
                'datas' => $this->getNotStudent($str1, $evaluated, $str2, $str3, $verify)
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function moyennePdf($str){
        try{
            list($class, $matter, $cutting) = explode("_", $str, 3);
            $classe = Classe::find($class);
            $matters = DisciplineLevel::find($matter);
            $cuttings = CuttingSchoolYear::find($cutting);
            $evaluated = Evuluated::where('cutting_school_year_id', $cutting)->where('classe_id', $class)->where('discipline_level_id', $matter)->orderBy('created')->get();
            $data = $this->getNotStudent($class, $evaluated, $matter, $cutting);
            $str = Str::upper(Str::random(2));
            $pdf = PDF::loadView('pages.evaluated.pdf.list_moyenne',[
                'classe' => $classe,
                'students' => $data,
                'matters' => $matters,
                'cuttings' => $cuttings,
                'evaluated' => $evaluated,
                'school' => School::first(),
                'enseignant' => $this->enseignant($class, $matter)
            ]);
            $pdf->setPaper('A4', 'portrait'); // ou 'A4', 'A3', etc.
            return $pdf->stream('liste_moyenne_'.$classe->libelle.'_'.$str.'.pdf');
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
            $exist = $this->getConfirm($dts['classe_id'], $dts['discipline_level_id'], $dts['cutting_school_year_id']);
            if(!$exist){
                $cutting = CuttingSchoolYear::find($dts['cutting_school_year_id']);
                if($cutting->status != 2){
                    $dts->delete();
                    $dts['sub_matter_id'] ?
                    SubMatterMoyenneJob::dispatch($dts['classe_id'], $dts['sub_matter_id'], $dts['cutting_school_year_id'], $dts['discipline_level_id']):
                    MatterMoyenneJob::dispatch($dts['classe_id'], $dts['discipline_level_id'], $dts['cutting_school_year_id']);
                    $str = 'info';
                    $msg = 'Suppression effectuée.';
                }
                else{
                    $str = 'warning';
                    $msg = 'Action inachevée, '.ucwords($cutting->cutting->libelle).' est terminé !';
                }
            }
            else{
                $str = 'warning';
                $msg = 'Action inachevée, moyenne déjà confirmée !';
            }
            return to_route('evaluated.back',$dts->classe_id.'_'.$dts->discipline_level_id )->with([
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


    private function getNotStudent($class, $evaluated, $matter, $cutting, $etat = null){
        $student = $this->getStudent($class);
        $table = [];
        foreach($student as $item){
            $table[] = [
                'id' => $item->id,
                'name' => strtoupper($item->first_name).' '.ucwords($item->last_name),
                'matricule' => $item->matricule,
                'genre' => ucwords($item->genre),
                'notes' => $etat ? $this->subMoyenneGet($item->id, $cutting):$this->getNotStudentMatte($item->id, $evaluated),
                'resultat' => MatterMoyenne::where('inscriptif_id', $item->id)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first()
            ];
        }

        return $table;
    }


    private function getMoyenneStudent($class, $matter, $cutting){
        $student = $this->getStudent($class);
        $table = [];
        foreach($student as $item){
            $table[] = [
                'id' => $item->id,
                'name' => strtoupper($item->first_name).' '.ucwords($item->last_name),
                'matricule' => $item->matricule,
                'genre' => ucwords($item->genre),
                'resultat' => MatterMoyenne::where('inscriptif_id', $item->id)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first()
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

    private function subMoyenneGet($student, $cutting){
        $table = [
            SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 1)->where('cutting_school_year_id', $cutting)->first(),
            SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 2)->where('cutting_school_year_id', $cutting)->first(),
            SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 3)->where('cutting_school_year_id', $cutting)->first()
        ];
        return $table;
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

    private function getMatters($level, $serie = null, $autre = null, $lv2 = null){
        
       $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat', DB::raw("IF(abbreviat = 'Mus/AP', '$autre', abbreviat) as abbreviat"))
        ->where('discipline_levels.level_id', '=', $level)
        ->where('discipline_levels.serie_id', '=', $serie)
        ->where('discipline_levels.discipline_id', '!=', '13') // Sauf Conduite id = 13 !
        ->orderBy('disciplines.libelle')->get();

        $data = $lv2 == 'mixte' ? $data->where('abbreviat', '!=', 'LV2'):$data;
        return $data ? json_decode($data, true):null;
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
        return match(true){
            strlen((string)$val) == 1 => '0'.$val,
            default => $val
        };
    }

    private function gettypeEvaluated(){
        $dts = EvaluadetType::orderBy('id')->get();
        return $dts;
    }


    private function getConfirm($class, $matter, $cutting){
        $dts = Approved::where('classe_id', $class)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first();
        return $dts;
    }


    private function addLv2Mixte($level, $serie = null, $lv2 = 'LV2'){
        $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', DB::raw("IF(libelle = 'Allemand/Espagnol', '$lv2', libelle) as libelle"))
        ->where('discipline_levels.level_id', '=', $level)
        ->where('discipline_levels.serie_id', '=', $serie)
        ->where('disciplines.abbreviat', '=', 'LV2')
        ->orderBy('disciplines.libelle')->first();
        $i = 0; $table = []; $tab = ['All', 'Esp'];
        while($i < 2){
            $table[] = [
                'id' => $data->id,
                'libelle' => $data->libelle,
                'abbreviat' => $tab[$i]
            ];
            $i++;
        }
        return $table;
    }

    private function enseignant($class, $matter){
        $data = ClasseUser::where('classe_id', $class)->where('discipline_level_id', $matter)->first();
        return $data ? ($data->user->civilite.' '.strtoupper($data->user->first_name).' '.ucwords($data->user->last_name)):null;
    }

    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
