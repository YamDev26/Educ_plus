<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\DaysWeek;
use App\Models\SlotTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($str)
    {
        try{
            $class = Classe::find($str);
            $days = DaysWeek::orderBy('order')->get();
            return view('pages.times.index', [
                'classe' => $class,
                'days' => $days
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
            $class = Classe::find($str);
            $days = DaysWeek::orderBy('order')->get();
            $times = SlotTime::get();
            $matters = $this->getMatters($class->level_id, $class->serie, $class->autre, $class->lv2);
            return view('pages.times.create', [
                'matters' => $matters,
                'classe' => $class,
                'times' => $times,
                'days' => $days,
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
}
