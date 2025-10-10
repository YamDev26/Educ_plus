<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try{
            $level = Level::find($id);
            return view('pages.levels.create',[
                'edits' => [],
                'level' => $level,
                'dts' => $this->getDiscipline()
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
                'mat' => 'required|array',
                'coef' => 'required|array',
                'mat.*' => 'required|string',
                'coef.*' => 'required|integer',
            ]);
            $level = Level::find($request['id']);
            if((count($val['mat']) == count($val['coef']) && $level)){
                $i = 0;
                while($i < count($val['mat'])){
                    $mats = explode('_', $val['mat'][$i]);
                    DisciplineLevel::create([
                        'level_id' => $level['id'],
                        'discipline_id' => $mats[0],
                        'coefficient' => $val['coef'][$i],
                    ]);
                    $i++;
                }
                return to_route('level.show',$level['id'])->with([
                    'str' => 'success',
                    'msg' => 'Matières ajoutées'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'danger',
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
        try{
            $level = Level::find($id);
            $dts = DisciplineLevel::where('level_id', $id)->orderBy('id')->get();
            return view('pages.levels.detail',[
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
    public function edit(string $id)
    {
        try{
            $level = Level::find($id);
            $dts = DisciplineLevel::where('level_id', $id)->orderBy('id')->get();
            return view('pages.levels.create',[
                'edits' => $dts,
                'level' => $level,
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
            $i = 0;
            while($i < count($val['mat'])){
                $mats = explode('_', $val['mat'][$i]);
                $dts = DisciplineLevel::where('level_id', $id)->where('discipline_id', $mats[0])->first();
                if($dts){
                    $dts->update(['coefficient' => $val['coef'][$i] ]);
                }
                else{
                    DisciplineLevel::create([
                        'level_id' => $id,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search(Request $request){
        try{
            $search = request('search'); // ou une variable $search
            $school = $this->school();
            $datas = Level::where('libelle', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->orderBy('created_at')
            ->paginate(10);
            return response()->json(['status' => count($datas) ? 200:201, 'data' => $datas]);
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
        $dts = Discipline::where('libelle', '!=', 'conduite')->orderBy('libelle')->get();
        if(!$school['informatique']){
            $dts = $dts->where('libelle', '!=', 'Arts plastique')->where('libelle', '!=', 'Musique');
        }
        return $dts;
    }


    private function school(){
        $school = School::first();
        return $school;
    }
}
