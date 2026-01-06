<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Level;
use App\Models\School;
use App\Models\Discipline;
use App\Models\DisciplineLevel;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $school = $this->school();
            $levels = Level::orWhere('college', $school['college'])->orWhere('lycee', $school['lycee'])->orderBy('id')->get();
            return view('pages.levels.index',[
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $level = Level::find($id);
            $serie = $level->lycee ? Serie::where(strtolower($level->code), '1')->orderBy('id')->get():[];
            $dts = $level->lycee ? $this->getDisciplineSerie($id, $serie):$this->getDisciplineCollege($id);
            return view($serie ? 'pages.levels.detail_2':'pages.levels.detail_1',[
                'dts' => $dts,
                'level' => $level
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
    public function edit(Request $request, string $id)
    {
        try{
            $serie = $request['serie'] ? Serie::find($request['serie']):null;
            $level = Level::find($id);
            $dts = $request['serie'] ? $this->getDisciplineLycee($id, $serie['id']):$this->getDisciplineCollege($id);
            return view('pages.levels.create',[
                'edits' => $dts,
                'level' => $level,
                'serie' => $serie,
                'dts' => $this->getDiscipline(),
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $val = $request->validate([
                'mat' => 'required|array',
                'coef' => 'required|array',
                'mat.*' => 'required|string',
                'coef.*' => 'required|integer',
            ]);
            $i = 0; $serie = $request['serie'];
            while($i < count($val['mat'])){
                $mats = explode('_', $val['mat'][$i]);
                $dts = $request['serie'] ? 
                DisciplineLevel::where('level_id', $id)->where('serie_id', $serie)->where('discipline_id', $mats[0])->first():
                DisciplineLevel::where('level_id', $id)->where('discipline_id', $mats[0])->first();
                if($dts){
                    $dts->update(['coefficient' => $val['coef'][$i] ]);
                }
                else{
                    DisciplineLevel::create([
                        'level_id' => $id,
                        'serie_id' => $serie ?? null,
                        'discipline_id' => $mats[0],
                        'coefficient' => $val['coef'][$i],
                    ]);
                }
                $i++;
            }
            return to_route('level.show',$id)->with([
                'str' => 'success',
                'msg' => 'Mise à jour effectué.'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    private function getDiscipline(){
        $school = $this->school();
        if($school['informatik'] && $school['autres']){
            $dts = Discipline::where('libelle', '!=', 'conduite')->orderBy('libelle')->get();
        }
        elseif($school['informatik'] && !$school['autres']){
            $dts = Discipline::where('libelle', '!=', 'conduite')
            ->where('libelle', '!=', 'Musique/Arts Plastique')
            ->orderBy('libelle')->get();
        }
        elseif(!$school['informatik'] && $school['autres']){
            $dts = Discipline::where('libelle', '!=', 'conduite')
            ->where('libelle', '!=', 'Informatique')
            ->orderBy('libelle')->get();
        }
        elseif(!$school['informatik'] && !$school['autres']){
            $dts = Discipline::where('libelle', '!=', 'conduite')
            ->where('libelle', '!=', 'Musique/Arts Plastique')
            ->where('libelle', '!=', 'Informatique')
            ->orderBy('libelle')->get();
        }
        return $dts;
    }


    private function getDisciplineSerie($level, $serie){
        $table = []; $i = 1; $tab = [1 => 'link_1', 2 => 'link_2', 3 => 'link_3', 4 => 'link_4'];
        foreach($serie as $item){
            $table[] = [
                'id' => $item->id,
                'link' => $tab[$i],
                'actif' => $i++,
                'libelle' => $item->libelle,
                'data' => $this->getDisciplineLycee($level, $item->id)
            ];
        }
        return $table;
    }


    private function getDisciplineCollege($level){
        $data = DisciplineLevel::where('level_id', $level)->orderBy('id')->get();
        return $data;
    }


    private function getDisciplineLycee($level, $serie){
        $data =  DisciplineLevel::where('level_id', $level)->where('serie_id', $serie)->orderBy('id')->get();
        return $data;
    }


    private function school(){
        $school = School::first();
        return $school;
    }
}
