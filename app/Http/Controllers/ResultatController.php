<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use APP\Models\SchoolYear;
use App\Models\CuttingSchoolYear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.resultats.index');
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                'cutting' => 'required|string',
            ]);
            $classe = Classe::find($val['class']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            return view('pages.resultats.detail',[
                'classe' => $classe,
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
    public function destroy(string $id)
    {
        //
    }

    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
