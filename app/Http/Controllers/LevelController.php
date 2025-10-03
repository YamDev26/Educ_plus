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
            $disciplines = Discipline::where('libelle', '!=', 'mixte')->where('libelle', '!=', 'conduite')->orderBy('libelle')->get();
            return view('pages.levels.create',[
                'disciplines' => $disciplines,
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
        try{
            $level = Level::find($id);
            $disciplines = Discipline::where('libelle', '!=', 'mixte')->where('libelle', '!=', 'conduite')->orderBy('libelle')->get();
            return view('pages.levels.detail',[
                'levels' => [],
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
}
