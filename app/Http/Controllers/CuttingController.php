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
            $date = Carbon::now()->format('Y-m-d');
            $this->saveCutting($valid, $date);
            return back()->with([
                'str' => 'success',
                'msg' => 'Enregistrement effectué.'
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
            $datas = Cutting::join('cutting_school_years', 'cuttings.id', '=', 'cutting_school_years.cutting_id')
            ->select('cuttings.libelle', 'cutting_school_years.start', 'cutting_school_years.end', 'cutting_school_years.id')
            ->where('cutting_school_years.school_year_id', $request['id'])->orderBy('cutting_school_years.created_at')->get();
            return response()->json($datas);
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
            $valid = $request->validate([
                'id' => 'required|array',
                'debut' => 'required|array',
                'fin' => 'required|array',
                'id.*' => 'required|integer',
                'debut.*' => 'required|date',
                'fin.*' => 'required|date',
            ]);
            $date = Carbon::now()->format('Y-m-d');
            $i = 0;
            while($i < sizeof($valid['id'])){
                $data = CuttingSchoolYear::find($valid['id'][$i]);
                $data->update([
                    'start' => $valid['debut'][$i],
                    'end' => $valid['fin'][$i],
                    'status' => compareToDate($date, $valid['debut'][$i], $valid['fin'][$i])
                ]);
                $i++;
            }
            return back()->with([
                'str' => 'info',
                'msg' => 'Modification prise en compte.'
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
    private function saveCutting($vals, $actuel){
        $i = 0;
        while($i < sizeof($vals['debut'])){
            CuttingSchoolYear::create([
                'school_year_id' => $vals['year'],
                'cutting_id' => $vals['id'][$i],
                'start' => $vals['debut'][$i],
                'end' => $vals['fin'][$i],
                'status' => compareToDate($actuel, $vals['debut'][$i], $vals['fin'][$i])
            ]);
            $i++; 
        }
    }

}
