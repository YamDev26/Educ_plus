<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\SchoolYear;
use App\Models\CuttingSchoolYear;
use App\Exports\ConduiteExport;
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
            return view('pages.conduite.detail',[
                'classe' => $class,
                'cutting' => $cutting,
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


    public function export(string $str){
        try{
            list($class, $cutting) = explode('_', $str, 2);
            $str = Str::upper(Str::random(2));
            $classe = Classe::find($class);
            $name = 'conduite_'.$str.'_'.$classe->libelle.'_'.$cutting;
            return Excel::download(new ConduiteExport($class, $cutting), $name.'.xlsx');
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

    /**
     * Remove the specified resource from storage.
     */
    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
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
                'santion' => [],
                'moyen' => []
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
}
