<?php

namespace App\Http\Controllers;

use App\Models\Cutting;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class CuttingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $year = SchoolYear::where('actif', '1')->first();
            $cutting = Cutting::where('info', $year['cutting'])->orderBy('created_at')->get();
            return view('pages.cutting.index',[
                'dts' => [],
                'cutting' => $cutting,
                'year' => $year['id']
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $valid = $request->validate([
                'id' => 'required|array',
                'debut' => 'required|array',
                'fin' => 'required|array',
                'debut.*' => 'required|date',
                'fin.*' => 'required|date',
            ]);
            
            $i = 0;
            while($i < sizeof($valid['debut'])){
                $start = $valid['debut'][$i] ?? null;
                $end = $valid['fin'][$i] ?? null;
                if($start && $end && strtotime($end) <= strtotime($start)){
                   return back()->with([
                        'str' => 'danger',
                        'msg' => 'Une erreur est survenue !'
                    ]); 
                }
                $i++;
            }

            dd($valid);
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
