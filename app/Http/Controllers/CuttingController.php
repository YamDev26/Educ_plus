<?php

namespace App\Http\Controllers;

use App\Models\Cutting;
use App\Models\SchoolYear;
use App\Models\CuttingSchoolYear;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            $dts = CuttingSchoolYear::where('school_year_id', $year['id'])->get();
            return view('pages.cutting.index',[
                'dts' => $dts,
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
                'year' => 'required|integer',
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
            $date = Carbon::now()->format('d-m-Y');
            $this->saveCutting($valid, $date);
            return back()->with([
                'str' => 'success',
                'msg' => 'Enregistrement effectué.'
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


    private function saveCutting($vals, $actuel){
        $i = 0;
        while($i < sizeof($vals['debut'])){
            CuttingSchoolYear::create([
                'school_year_id' => $vals['year'],
                'cutting_id' => $vals['id'][$i],
                'start' => $vals['debut'][$i],
                'end' => $vals['fin'][$i],
                'status' => $this->infoDate($vals['debut'][$i], $vals['fin'][$i], $actuel)
            ]);
            $i++; 
        }
    }


    private function infoDate($actuels, $debuts, $fins){
        $status = ['0', '1', '2'];
        $actuel = strtotime($actuels);
        $debut = strtotime($debuts);
        $fin = strtotime($fins);
        if((($debut) > $actuel) && ($fin > $actuel)){
            return $status[0];
        }
        elseif(($debut <= $actuel) && ($fin >= $actuel)){
            return $status[1];
        }
        elseif(($debut < $actuel) && ($fin < $actuel)){
            return $status[2];
        }
    }

}
