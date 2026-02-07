<?php

namespace App\Http\Controllers;

use App\Models\DaysWeek;
use App\Models\SlotTime;
use App\Models\SchoolYear;
use App\Events\CuttingEvent;
use App\Models\CuttingSchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // utilisateur connecté ------------
            $user = Auth::user();

            // Déclenchement d'événement
            event(new CuttingEvent($this->year()));
            if($user->role_id != 6){
                return view('pages.dashboard.index_1');
            }
            else{

                $cutting = $this->cuttingActif();
                $date = Carbon::now();
                $nombre = $cutting ? Carbon::parse($date->format('Y-m-d'))->diffInDays(Carbon::parse($cutting['end'])):null;
                // $tableTiem2 = $this->tableTime($user->id, 2); //dd($tableTiem2);
                return view('pages.dashboard.index_2',[
                    'times' => $this->getTimes(),
                    'days' => $this->getDay(),
                    'nombre' => (int)$nombre,
                    'cutting' => $cutting
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


     private function tableTime($user, $moment){
        $datas = DB::table('classes')
        ->join('table_times', 'classes.id', '=', 'table_times.classe_id')
        ->join('classe_users', 'classes.id', '=', 'classe_users.classe_id')
        ->select('classes.libelle', 'table_times.slot_time_id', 'table_times.days_week_id', 'classe_users.user_id')
        ->where('classes.school_year_id', '=', $this->year())
        ->where('table_times.moment', '=', $moment)
        ->where('classe_users.user_id', '=', $user)
        ->distinct()->get();
        return $datas;
    }

    /**
     * Remove the specified resource from storage.
     */
    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }


    private function getDay(){
        $days = DaysWeek::orderBy('order')->get();
        return $days;
    }


    private function getTimes(){
        $morning = SlotTime::where('statut', '1')->orderBy('order')->get();
        $after = SlotTime::where('statut', '2')->orderBy('order')->get();
        return ['time1' => $morning, 'time2' => $after];
    }


    private function cuttingActif(){
      $dts =  CuttingSchoolYear::where('status', '1')->where('school_year_id',  $this->year())->first();
      return $dts;
    }
}
