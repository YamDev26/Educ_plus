<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\SubMatter;
use App\Models\Evuluated;
use App\Models\SchoolYear;
use App\Models\EvaluadetType;
use App\Models\EvaluatedNote;
use App\Models\DisciplineLevel;
use App\Exports\EvaluatedExport;
use App\Models\CuttingSchoolYear;
use App\Services\EvaluatedService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\EditMoyenneEvent;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EvaluatedController extends Controller
{
    protected $evaluated;
    public function __construct(EvaluatedService $evaluated)
    {
        $this->evaluated = $evaluated;
    }
    
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
            return ('<div class="d-flex justify-content-center">
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
            $approved = $this->evaluated->nonApproved($val['classe'], $val['matter'], $val['cutting']);
            if(!$approved){
                $verif = $this->evaluated->verify($val['classe'], $val['matter'], $val['cutting'], $val['type'], $val['values'], $val['date']);
                if(!$verif){
                    $val = $this->evaluated->createEvaluated(
                        $val['values'], $val['date'], $val['classe'], $request['sub'], $val['type'], $val['matter'], $val['cutting']
                    );
                    return to_route('evaluated.note', $val)->with([
                        'msg' => 'Ajoutez les notes',
                        'teacher' => false
                    ]);
                }
                else{
                    $str = 'warning'; $msg = 'Evaluation déjà créée.';
                }
            }
            else{
                $str = 'warning'; $msg = 'Action inachevée, moyenne déjà confirmée !';
            }
            return to_route('evaluated.back', $val['classe'].'_'.$val['matter'])->with([
                'str' => $str,
                'msg' => $msg,
                'teacher' => false
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
            $datas = $this->evaluated->getStudent($evaluated->classe_id);
            return view('pages.evaluated.create',[
                'evaluated' => $evaluated,
                'students' => $datas,
                'teacher' => false
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
        $val = $request->validate([
            'evaluated' => 'required|string',
            'student' => 'required|array',
            'student.*' => 'required|string',
            'note' => 'required|array',
            'note.*' => 'nullable|string',
        ]);
        $count = EvaluatedNote::where('evuluated_id', $val['evaluated'])->count();
        if(!$count){
            $evaluated = Evuluated::find($val['evaluated']);
            $this->evaluated->saveNote($val['student'], $val['note'], $evaluated);
            $str = 'success'; $msg = 'Notes ajoutée avec success !';
        }
        else{
            $str = 'danger'; $msg = 'Erreur, tentative de duplicaation !';
        }
        return to_route('evaluated.list', $val['evaluated'])->with([
            'str' => $str, 
            'msg' => $msg,
            'teacher' => false
        ]);
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
            $datas = $this->evaluated->getEvaluated($class, $id);
            return view('pages.evaluated.show',[
                'data' => $datas,
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => $subMatter ?? null,
                'typeEvaluated' => $this->gettypeEvaluated(),
                'teacher' => false
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
                $this->evaluated->import($request['evaluated'], $request->file('fichier'));
                return to_route('evaluated.list', $request['evaluated'])->with([
                    'str' => 'success', 
                    'msg' => 'Fichier importé avec succès !',
                    'teacher' => false
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
            $datas = $this->evaluated->getEvaluated($class, $matter->id);
            return view('pages.evaluated.show',[
                'data' => $datas,
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => $subMatter ?? null,
                'typeEvaluated' => $this->gettypeEvaluated(),
                'teacher' => false
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
            $datas = $this->evaluated->getNotStudentEndMatter($str);
            $cutting = CuttingSchoolYear::find($evaluated->cutting_school_year_id);
            $exist = $this->evaluated->nonApproved($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
            return view('pages.evaluated.liste',[
                'students' => $datas,
                'evaluated' => $evaluated,
                'status' =>  ($exist || $cutting->status == 2) ? false:true,
                'teacher' => false
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function generate($str){
        try{
            $evaluated = Evuluated::find($str);
            $char = Str::upper(Str::random(2));
            $pdf = $this->evaluated->pdf($evaluated, $str);
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
            $data = $this->evaluated->getMoyenneStudent($class, $matter, $cutting);
            return view('pages.evaluated.edit',[
                'data' => $data,
                'classe' => $classe,
                'matter' => $matters,
                'cutting' => $cuttings,
                'teacher' => false,
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
                'msg' => 'Modification prise en compte avec success !',
                'teacher' => false,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function approved(Request $request){
        try{
            list($class, $matter, $cutting) = explode("_", $request['str'], 3);
            $this->evaluated->approved($class, $matter, $cutting);
            return to_route('evaluated.return', $request['str'])->with([
                'str' => 'info',
                'msg' => 'Moyennes conrfirmées avec succes !',
                'teacher' => false,
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
            $evaluated = Evuluated::find($val['evaluated']);
            $this->evaluated->updateNote($val['student'], $val['note'], $evaluated);
            return to_route('evaluation.list', $val['evaluated'])->with([
                'str' => 'info', 
                'msg' => 'Mise à jour éffectuée !',
                'teacher' => false,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function detail(Request $request){
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
            $exist = $this->evaluated->nonApproved($val['class'], $val['matter'], $val['cutting']);
            $evaluated = $this->evaluated->evaluat($cutting['id'], $class['id'], $matter['id'], $verify);
            $datas = $this->evaluated->getNotStudent($class['id'], $evaluated, $val['matter'], $val['cutting'], $verify);
            return view('pages.evaluated.resultat',[
                'exist' => $exist,
                'datas' => $datas,
                'verify' => $verify,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting,
                'evaluated' => $evaluated,
                'teacher' => false,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function detail1($str){
        try{
            list($str1, $str2, $str3) = explode("_", $str, 3);
            $class = Classe::find($str1);
            $matter = DisciplineLevel::find($str2);
            $cutting = CuttingSchoolYear::find($str3);
            $verify = verifyMatterCycle($class, $matter);
            $exist = $this->evaluated->nonApproved($str1, $str2,$str3);
            $evaluated = $this->evaluated->evaluat($cutting['id'], $class['id'], $matter['id'], $verify);
            $datas = $this->evaluated->getNotStudent($class['id'], $evaluated, $str2, $str3, $verify);
            return view('pages.evaluated.resultat',[
                'exist' => $exist,
                'datas' => $datas,
                'verify' => $verify,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting,
                'evaluated' => $evaluated,
                'teacher' => false,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function generate_2($str){
        try{
            list($class, $matter, $cutting) = explode("_", $str, 3);
            $classe = Classe::find($class);
            $pdf = $this->evaluated->pdf2($str);
            $str = Str::upper(Str::random(2));
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
            $result = $this->evaluated->destroy($dts);
            return to_route('evaluated.back',$dts->classe_id.'_'.$dts->discipline_level_id )->with([
                'str' => $result[0],
                'msg' => $result[1],
                'teacher' => false
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
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


    private function gettypeEvaluated(){
        $dts = EvaluadetType::orderBy('id')->get();
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

    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
