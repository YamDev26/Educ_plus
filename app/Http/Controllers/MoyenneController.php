<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classe;
use App\Models\Moyenne;
use App\Models\Approved;
use App\Models\SchoolYear;
use App\Models\ClasseUser;
use App\Models\MatterMoyenne;
use App\Models\DisciplineLevel;
use App\Models\CuttingSchoolYear;
use App\Events\EditMoyenneEvent;
use App\Jobs\CalculMoyenneClasseMatter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;

class MoyenneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.moyennes.index');
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
            return ('<div class="py-1 d-flex justify-content-center">
                <button data-id="'.$data->id.'" data-lib="'.$data->libelle.'" class="btn btn-outline-light py-0 px-1" style="border: none; border-radius: 3px">
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

    public function geeratePdf($str){
        try{
            list($id1, $id2) = explode('_', $str, 2);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $name = 'liste_moyenne_'.$cutting->cutting->libelle.'_'.$class->libelle;
            $pdf = PDF::loadView('pages.moyennes.pdf.list_moyenne_classe',[
                'classe' => $class,
                'cutting' => $cutting,
                'school' => School::first(),
                'matters' => $this->getMatters($class),
                'data' => $this->getMoyenneStudent($class, $id2),
                'enseignant' => $this->enseignant($id1),
            ])->setPaper('A4', 'landscape');// ou 'A4', 'A3', etc.
            return $pdf->stream($name.'.pdf');
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
            $class = Classe::find($request['id1']);
            $data = $this->getMatterApproved($class, $request['id2']);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            return view('pages.moyennes.detail',[
                'classe' => $class,
                'cutting' => $cutting,
                'matters' => $this->getMatters($class),
                'data' => $this->getMoyenneStudent($class, $val['cutting'])
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
    public function edit(Request $request)
    {
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'matter' => 'required|string',
                'cutting' => 'required|string'
            ]);
            $class = Classe::find($val['class']);
            $matter = DisciplineLevel::find($val['matter']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            $data = $this->getMoyenneMatterStudent($class, $val['cutting'], $val['matter']);
            return view('pages.moyennes.edit',[
                'data' => $data,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting
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
                'str' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'moyen' => 'required|array',
                'moyen.*' => 'nullable|string',
            ]);

            list($id1, $id2, $id3) = explode('_', $val['str'], 3);
            event(new EditMoyenneEvent($val['student'], $val['moyen'], $id3, $id2)); // Déclenchement d'événement
            CalculMoyenneClasseMatter::dispatch($id1, $id3, $id2); // Déclenchement de job pour le calcul de moyenne
            $class = Classe::find($id1);
            $matter = DisciplineLevel::find($id3);
            $cutting = CuttingSchoolYear::find($id2);
            $data = $this->getMoyenneMatterStudent($class, $id2, $id3);
            return view('pages.moyennes.edit',[
                'data' => $data,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting
            ])->with([
                'str' => 'info',
                'msg' => 'Modification prise en compte avec succes !'
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
    public function destroy(string $id)
    {
        //
    }


    private function getMoyenneStudent($class, $cutting){
        $data = $this->getStudent($class);
        $student = [];
        foreach($data as $item){
            $student[] = [
                'id' => $item['id'],
                'genre' => $item['genre'],
                'matricule' => $item['matricule'],
                'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
                'moyens' => $this->getMoyenMatter($item['id'], $class, $cutting),
                'moyen' => Moyenne::where('inscriptif_id', $item['id'])->where('cutting_school_year_id', $cutting)->first()
            ];
        }
        return $student;
    }


    private function getMoyenneMatterStudent($class, $cutting, $matter){
        $data = $this->getStudent($class);
        $student = [];
        foreach($data as $item){
            $student[] = [
                'id' => $item['id'],
                'genre' => $item['genre'],
                'matricule' => $item['matricule'],
                'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
                'moyen' => $this->moyenneMatter($item['id'], $cutting, $matter)
            ];
        }
        return $student;
    }


    private function getMoyenMatter($student, $class, $cutting){
        $matters = $this->getMatters($class);
        $data = [];
        foreach($matters as $item){
            $data[] = $this->moyenneMatter($student, $cutting, $item['id']);
        }
        return $data;
    }

    private function moyenneMatter($student, $cutting, $matter){
        $verify = Approved::where('cutting_school_year_id', $cutting)->where('discipline_level_id', $matter)->first();
        $val = $verify ? MatterMoyenne::where('inscriptif_id', $student)->where('cutting_school_year_id', $cutting)->where('discipline_level_id', $matter)->first():null;
        return $val ? $val['moyenne']:'---';
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

    protected function getMatters($class){
        // if(in_array($class['level_id'], [1, 2, 3, 4])){
        //     return array_merge($this->subMatter(),$this->matters($class, 1), $this->matters($class, 2), $this->matters($class, 3));
        // }
        return array_merge($this->matters($class, 1), $this->matters($class, 2), $this->matters($class, 3));
    }

    private function matters($class, $bilan){
        $autre = $class['autre'] ? ($class['autre'] == 'musique' ? 'Mus':'AP'):null;
        $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat', DB::raw("IF(abbreviat = 'Mus/AP', '$autre', abbreviat) as abbreviat"))
        ->where('discipline_levels.level_id', '=', $class['level_id'])
        ->where('discipline_levels.serie_id', '=', $class['serie_id'])
        ->where('disciplines.bilan_matter_id', '=', $bilan)
        ->orderBy('disciplines.bilan_ordre')->get();
        return $data ? json_decode($data, true):null;
    }

    private function subMatter(){
        $data = DB::table('sub_matters')
        ->select('sub_matters.id', 'sub_matters.libelle', 'sub_matters.abbreviated as abbreviat')
        ->orderBy('sub_matters.id')->get();
        return $data ? json_decode($data, true):null;
    }


    private function getMatterApproved($class, $cutting){
        $autre = $class['autre'] ? ($class['autre'] == 'musique' ? 'Mus':'AP'):null;
        $data = DB::table('approveds')
        ->join('discipline_levels', 'discipline_levels.id', '=', 'approveds.discipline_level_id')
        ->join('disciplines', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat', DB::raw("IF(abbreviat = 'Mus/AP', '$autre', abbreviat) as abbreviat"))
        ->where('discipline_levels.level_id', $class['level_id'])
        ->where('discipline_levels.serie_id', $class['serie_id'])
        ->where('approveds.cutting_school_year_id', $cutting)
        ->orderBy('disciplines.libelle')->get();
        return $data ? json_decode($data, true):null; 
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

    private function enseignant($class){
        $data = ClasseUser::where('classe_id', $class)->where('pp', '1')->first();
        return $data ? ($data->user->civilite.' '.strtoupper($data->user->first_name).' '.ucwords($data->user->last_name)):null;
    }

    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
