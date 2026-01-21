<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Approved;
use App\Models\absensTime;
use App\Models\SchoolYear;
use App\Models\MatterMoyenne;
use App\Models\CuttingSchoolYear;
use App\Exports\ConduiteExport;
use App\Imports\ConduiteImport;
use App\Jobs\GestionCndteJob;
use App\Jobs\CalculMoyenneClasseMatter;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConduiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.conduite.index');
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
                <button data-id="'.$data->id.'" class="btn btn-outline-light py-0 px-1 btnCutting" style="border: none; border-radius: 3px">
                <i class="fadeIn animated bx bx-slider m-0" style="font-size: 17px"></i>
                </button>
            </div>');
        })
        ->rawColumns(['counter', 'inscrit', 'action'])
        ->make(true);
    }


    public function search(){
        try{
            $cutting = CuttingSchoolYear::where('school_year_id', $this->year())->get();
            return Response()->json([
                'status' => $cutting ? 200:201,
                'data' => $cutting ? $this->getCutting($cutting):null
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
    public function create($str)
    {
        try{
            list($id1, $id2) = explode('_', $str);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $matter = $this->getMatter($class['level_id'], $class['serie_id']);
            return view('pages.conduite.create',[
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting,
                'data' => $this->getMoyenneStudent($class, $matter->id, $id1)
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
    public function store(Request $request)
    {
        try{
            $val = $request->validate([
                'matter' => 'required|integer',
                'cutting' => 'required|integer',
                'class' => 'required|string',
                'stdt' => 'required|array',
                'stdt.*' => 'required|string',
                'moyen' => 'required|array',
                'justifie' => 'required|array',
                'justifieNon' => 'required|array',
            ]);
            $verify = $this->verify($val['class'], $val['matter'], $val['cutting']);
            if(!$verify){
                // Déclenchement de job pour le calcul de moyenne   
                GestionCndteJob::dispatch($val['stdt'], $val['moyen'], $val['justifie'], $val['justifieNon'], $val['matter'], $val['cutting'])->delay(now()->addSeconds(2));
                $str = 'success';
                $msg = 'Tout c\'est bien passé, traitement en cours';
            }
            else{
                $str = 'warning';
                $msg = 'Moyenne déjà approuvées';
            }
            return to_route('conduite.return', $val['class'].'_'.$val['cutting'])->with([
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
                'class' => 'required|string',
                'cutting' => 'required|string'
            ]);
            $class = Classe::find($val['class']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            $matter = $this->getMatter($class['level_id'], $class['serie_id']);
            return view('pages.conduite.detail',[
                'classe' => $class,
                'cutting' => $cutting,
                'matter' => $matter,
                'data' => $this->getMoyenneStudent($class, $matter->id, $val['cutting']),
                'approved' => $this->verify($val['class'], $matter->id, $val['cutting'])
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function getReturn(string $str){
       try{
            list($id1, $id2) = explode('_', $str, 2);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $matter = $this->getMatter($class['level_id'], $class['serie_id']);
            return view('pages.conduite.detail',[
                'classe' => $class,
                'cutting' => $cutting,
                'matter' => $matter,
                'data' => $this->getMoyenneStudent($class, $matter->id, $id2),
                'approved' => $this->verify($id1, $matter->id, $id2)
            ]);
       }
       catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function export(string $str){
        try{
            list($class, $cutting) = explode('_', $str, 2);
            $str = Str::upper(Str::random(2));
            $classe = Classe::find($class);
            $cuting = CuttingSchoolYear::find($cutting);
            $libelle = str_replace(' ', '', $cuting->cutting->libelle).'_'.$cuting->id;
            $name = 'file_conduite_'.$str.'_'.$classe->libelle.'_'.$classe->id.'_'.$libelle;
            return Excel::download(new ConduiteExport($class, $cutting), $name.'.xlsx');
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
            $val = $request->validate([
                'class' => 'required|string',
                'matter' => 'required|string',
                'cutting' => 'required|string',
                'files' => 'required|mimes:xlsx,xls|max:2048'
            ]);
            $file_name = $request->file('files')->getClientOriginalName();
            list($name1, $name2) = explode(".", $file_name, 2);
            list($file, $lib1, $str, $lib2, $class, $lib3, $cutting) = explode("_", $name1);
            if(($val['class'] == $class) &&  ($val['cutting'] == $cutting)){
                $verify = $this->verify($class, $val['matter'], $cutting);
                if(!$verify){
                    Excel::import(new ConduiteImport($val['matter'], $val['cutting']), $request->file('files'));
                    $str = 'success';
                    $msg = 'Tout c\'est bien passé, traitement en cours';
                }
                else{
                    $str = 'warning';
                    $msg = 'Moyenne déjà approuvées';
                }
                return to_route('conduite.return', $val['class'].'_'.$val['cutting'])->with([
                    'str' => $str,
                    'msg' => $msg
                ]);
            }
            else{
                return back()->with([
                    'str' => 'danger',
                    'msg' => 'Une erreur est survenue !'
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function approved(Request $request){
        try{
            $val = $request->validate([
                'str' => 'required|string'
            ]);
            list($class, $matter, $cutting) = explode('_', $val['str'], 3);
            if(!$this->verify($class, $matter, $cutting)){
                Approved::create([
                    'classe_id' => $class,
                    'discipline_level_id' => $matter,
                    'cutting_school_year_id' => $cutting
                ]);
                // Déclenchement de job pour le calcul de moyenne
                CalculMoyenneClasseMatter::dispatch($class, $matter, $cutting);
                $str = 'success';
                $msg = 'Tout c\'est bien passé, traitement en cours';
            }
            else{
                $str = 'warning';
                $msg = 'Moyenne déjà approuvées';
            }
            return to_route('conduite.return', $class.'_'.$cutting)->with([
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
     * Remove the specified resource from storage.
     */
    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }


    private function getMoyenneStudent($class, $matter, $cutting){
        $data = $this->getStudent($class);
        $student = [];
        foreach($data as $item){
            $student[] = [
                'id' => $item['id'],
                'genre' => $item['genre'],
                'matricule' => $item['matricule'],
                'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
                'time' => $this->absensTime($item['id'], $cutting),
                'moyen' => $this->moyen($item['id'], $matter, $cutting)
            ];
        }
        return $student;
    }


    private function getStudent($class){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', '=', $class['id'])
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return json_decode($data, true);
    }

    private function getCutting($data){
        $table = [];
        foreach($data as $item){
            $table[] = [
                'id' => $item->id,
                'libelle' => ucwords($item->cutting->libelle)
            ];
        }
        return $table;
    }


    private function getMatter($level, $serie = null){
        $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat')
        ->where('discipline_levels.level_id', $level)
        ->where('discipline_levels.serie_id', $serie)
        ->where('disciplines.libelle', 'conduite')
        ->first();
        return $data;
    }


    private function moyen($student, $matter, $cutting){
       $val = MatterMoyenne::where('inscriptif_id',$student)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first();
       return $val ?? null;
    }


    private function absensTime($student, $cutting){
        $item = absensTime::where('inscriptif_id', $student)->where( 'cutting_school_year_id', $cutting)->first();
        return $item ?? null;
    }


    private function verify($class, $matter, $cutting){
        $dts = Approved::where('classe_id', $class)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first();
        return  $dts ?? null;
    }
}
