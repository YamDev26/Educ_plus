<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Level;
use App\Models\Classe;
use App\Models\School;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $school = $this->school();
            $levels = Level::orWhere('college', $school['college'])->orWhere('lycee', $school['lycee'])->orderBy('id')->get();
            return view('pages.classes.index',[
                'levels' => $levels
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
    public function store(Request $request, )
    {
        try{
            $val = $request->validate([
                'level' => 'required|string',
                'effectif' => 'required|integer',
                'number' => 'required|integer',
                'serie' => 'nullable|string',
                'lv2' => 'nullable|string'
            ]);
            $year = $this->year();
            $str = explode('_', $val['level']);
            $serie = in_array($str[0], [5, 6, 7]) ? explode('_', $val['serie']):null;
            $count = Classe::where('level_id', $str[1])->where('serie_id', $serie ? $serie['id']:null)->where('school_year_id', $year)->count();
            $i = 1;
            while($i <= $val['number']){
                $lib = $request['serie'] ? $str[1].$serie[1].($count+$i):$str[1].($count+$i);
                Classe::create([
                    'libelle' => $lib,
                    'effectif' => $val['effectif'],
                    'level_id' => $str[0],
                    'school_year_id' => $year,
                    'lv2' => $request['lv2'] ? $val['lv2']:null,
                    'serie_id' => $request['serie'] ? $serie[0]:null
                ]);
                $i++;
            }
            return back()->with([
                'str' => 'success',
                'msg' => 'Enregistrement effecté avec succes.'
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
        try{
            $level = Level::find($id);
            $serie = $id > 4 ? Serie::where($level['code'], '1')->orderBy('id')->get():null;
            $data = Classe::where('level_id', $id)->where('school_year_id', $this->year())->orderBy('created_at', 'desc')->get();
            return view('pages.classes.detail',[
                'level' => $level,
                'serie' => $serie,
                'data' => $data
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


    private function school(){
        $school = School::first();
        return $school;
    }


    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}