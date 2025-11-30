<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
    public function show(string $id)
    {
        //
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
}
