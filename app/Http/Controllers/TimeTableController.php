<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classe;
use App\Models\DaysWeek;
use App\Models\SlotTime;
use App\Models\TableTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

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
            $dts = TableTime::where('classe_id', $str)->get();
            return view('pages.times.index', [
                'classe' => $class,
                'days' => $days,
                'times' => $this->getTimes(),
                'dts_1' => $dts ? $dts->where('moment', '1'):null,
                'dts_2' => $dts ? $dts->where('moment', '2'):null,
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
            $dts = TableTime::where('classe_id', $str)->get();
            $matters = $this->getMatters($class->level_id, $class->serie, $class->autre, $class->lv2);
            if(!$matters){
                return back()->with([
                    'str' => 'danger',
                    'msg' => 'Une erreur est survenue !'
                ]);
            }
            return view('pages.times.create', [
                'matters' => $matters,
                'classe' => $class,
                'days' => $days,
                'data' => count($dts),
                'times' => $this->getTimes(),
                'martin' => $dts ? $dts->where('moment', '1'):null,
                'soirs' => $dts ? $dts->where('moment', '2'):null,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function search(Request $request){
        try{
            list($mat, $time, $day, $other) = explode('_', $request['val'], 4);
            $search = Classe::join('table_times', 'classes.id', '=', 'table_times.classe_id')
            ->join('classe_users', 'classes.id', '=', 'classe_users.classe_id')
            ->where('table_times.classe_id', $request['str'])
            ->where('table_times.discipline_level_id', $mat)
            ->where('table_times.slot_time_id', $time)
            ->where('table_times.days_week_id', $day)
            ->count();
            return response()->json([
                'status' => $search ? 200:201
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
                'class' => 'required|string',
                'select' => 'required|array',
                'select.*' => 'required|string'
            ]);
            if(!(count(array_unique($val['select'])) === 1)){ // Verifie si toutes les valeurs sont les même .......
                // SUpprimer les valeurs existantes pour cette calsse
                TableTime::where('classe_id', $val['class'])->delete();
                foreach($val['select'] as $item){
                    if($item !== 'nc'){
                        list($mat, $time, $day, $other) = explode('_', $item, 4);
                        TableTime::create([
                            'moment' => $other,
                            'classe_id' => $val['class'],
                            'slot_time_id' => $time,
                            'days_week_id' => $day, // id => [1 - 5]
                            'discipline_level_id' => $mat
                        ]);
                    }
                }
                return to_route('time.index', $val['class'])->with([
                    'str' => 'info',
                    'msg' => 'Emploi du temps disponible !'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
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
    public function generate($str)
    {
        try{
            $class = Classe::find($str);
            $days = DaysWeek::orderBy('order')->get();
            $dts = TableTime::where('classe_id', $str)->get();
            $name = 'emploi_du_temps'.'_'.$class->libelle;
            $pdf = PDF::loadView('pages.times.pdf.list_pdf',[
                'classe' => $class,
                'days' => $days,
                'school' => School::first(),
                'times' => $this->getTimes(),
                'dts_1' => $dts ? $dts->where('moment', '1'):null,
                'dts_2' => $dts ? $dts->where('moment', '2'):null,
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

    private function getTimes(){
        $morning = SlotTime::where('statut', '1')->orderBy('order')->get();
        $after = SlotTime::where('statut', '2')->orderBy('order')->get();
        return ['time1' => $morning, 'time2' => $after];
    }
}
