<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Evuluated;
use App\Models\SubMatter;
use App\Models\ClasseUser;
use App\Models\SchoolYear;
use App\Models\EvaluatedNote;
use App\Models\EvaluadetType;
use App\Models\CuttingSchoolYear;
use Illuminate\Http\Request;
use App\Models\DisciplineLevel;
use App\Events\EditMoyenneEvent;
use App\Services\EvaluatedService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EvaluatedExport;
use Illuminate\Support\Str;

class EvaluatedTacher extends Controller
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
            $dts = $this->classeUser();
            return view('pages.evaluations.index',[
                'dts' => $dts
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
    public function create(Request $request){
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
                    return to_route('evaluation.note', $val)->with([
                        'msg' => 'Ajoutez les notes',
                        'teacher' => true
                    ]);
                }
                else{
                    $str = 'warning'; $msg = 'Evaluation déjà créée.';
                }
            }
            else{
                $str = 'warning'; $msg = 'Action inachevée, moyenne déjà confirmée !';
            }
            return to_route('evaluation.back', $val['classe'].'_'.$val['matter'])->with([
                'str' => $str,
                'msg' => $msg,
                'teacher' => true
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function addNote($str){
        try{
            $evaluated = Evuluated::find($str);
            $datas = $this->evaluated->getStudent($evaluated->classe_id);
            return view('pages.evaluated.create',[
                'evaluated' => $evaluated,
                'students' => $datas,
                'teacher' => true
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
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
        return to_route('evaluation.list', $val['evaluated'])->with([
            'str' => $str, 
            'msg' => $msg,
            'teacher' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'matter' => 'required|string',
            ]);
            list($id, $str) = explode('_', $val['matter']);
            $class = Classe::find($val['class']); 
            $matter = DisciplineLevel::find($id);
            getClasseMixte($str) ? session(['lv2' => getClasseMixte($str)]):null;
            if(!$class['serie_id']){
                $subMatter = $matter->discipline->libelle == 'Français' ? SubMatter::get():null;
            }
            $dts = $this->evaluated->getEvaluated($class, $id);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => $subMatter ?? null,
                'data' => $dts,
                'typeEvaluated' => $this->getTypeEvaluated(),
                'teacher' => true
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
                return to_route('evaluation.list', $request['evaluated'])->with([
                    'str' => 'success', 
                    'msg' => 'Fichier importé avec succès !',
                    'teacher' => true
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

    /**
     * Display the specified resource.
     */
    public function back($str){
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
                'teacher' => true
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
    public function getNote($str){
        try{
            $evaluated = Evuluated::find($str);
            $datas = $this->evaluated->getNotStudentEndMatter($str);
            $cutting = CuttingSchoolYear::find($evaluated->cutting_school_year_id);
            $exist = $this->evaluated->nonApproved($evaluated['classe_id'], $evaluated['discipline_level_id'], $evaluated['cutting_school_year_id']);
            return view('pages.evaluated.liste',[
                'students' => $datas,
                'evaluated' => $evaluated,
                'teacher' => true,
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
    public function edit(string $str){
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
                'teacher' => true,
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
    public function updateM(Request $request){
        try{
            $val = $request->validate([
                'str' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'moyen' => 'required|array',
                'moyen.*' => 'nullable|string',
            ]);
            list($class, $matter, $cutting) = explode("_", $val['str'], 3);
            event(new EditMoyenneEvent($val['student'], $val['moyen'], $matter, $cutting));
            return to_route('evaluation.str', $class.'_'.$matter.'_'.$cutting)->with([
                'str' => 'info', 
                'msg' => 'Modification prise en compte avec success !',
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
            return to_route('evaluation.str', $request['str'])->with([
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
    public function update(Request $request){
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
                'teacher' => true,
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
                'teacher' => true,
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
            $exist = $this->evaluated->nonApproved($str1, $str2, $str3);
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
                'teacher' => true,
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
    public function destroy(Request $request){
        try{
            $val = $request->validate([
                'id' => 'required|string'
            ]);
            $dts = Evuluated::find($val['id']);
            $result = $this->evaluated->destroy($dts);
            return to_route('evaluation.back',$dts->classe_id.'_'.$dts->discipline_level_id )->with([
                'str' => $result[0],
                'msg' => $result[1],
                'teacher' => true
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function ajax(Request $request){
        try{
            $dts = ClasseUser::where('classe_id', $request['id'])->where('user_id', $this->users())->get();
            $table = [];
            foreach($dts as $item){
                $libelle = $item->discipline_level->discipline->abbreviat;
                $table[] = [
                    'id' => $item->discipline_level_id,
                    'libelle' => $libelle
                ];
            }
            return $table;
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    private function classeUser(){
        $datas = Classe::join('classe_users', 'classes.id', '=', 'classe_users.classe_id')
        ->select('classes.libelle', 'classes.id', 'classes.inscrit', 'classes.effectif', 'classes.level_id')
        ->where('classes.school_year_id', '=', $this->year())
        ->where('classe_users.user_id', $this->users())
        ->distinct()
        ->orderBy('classes.level_id', 'asc')
        ->get();
        return $datas;
    }


    private function getTypeEvaluated(){
        $dts = EvaluadetType::orderBy('id')->get();
        return $dts;
    }


    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }


    private function users(){
        $user = Auth::user();
        return $user->id;
    }
}
