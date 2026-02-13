<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClasseUser;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\EvaluadetType;
use App\Models\DisciplineLevel;
use App\Services\EvaluatedService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EvaluatedTacher extends Controller
{
    protected $evaluated;
    public function __construct(EvaluatedService $evaluated)
    {
        $this->evaluated = $evaluated;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $dts = $this->classeUser();
            return view('pages.evaluations.index',[
                'dts' => $dts
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'matter' => 'required|string',
            ]);
            // dd($val);
            // list($id, $str) = explode('_', $val['matter']);
            $class = Classe::find($val['class']); 
            $matter = DisciplineLevel::find($val['matter']);

            $dts = $this->evaluated->getEvaluated($class, $val['matter']);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'subMatter' => null,
                'data' => $dts,
                'typeEvaluated' => $this->getTypeEvaluated(),
                'teacher' => true
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


    public function ajax(Request $request){
        try{
            $dts = ClasseUser::where('classe_id', $request['id'])->where('user_id', $this->users())->get();
            $table = [];
            foreach($dts as $item){
                $libelle = $item->discipline_level->discipline->abbreviat;
                $table[] = [
                    'id' => $item->discipline_level_id,
                    'libelle' => $libelle
                ];
            }
            return $table;
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    private function classeUser(){
        $datas = Classe::join('classe_users', 'classes.id', '=', 'classe_users.classe_id')
        ->select('classes.libelle', 'classes.id', 'classes.inscrit', 'classes.effectif', 'classes.level_id')
        ->where('classes.school_year_id', '=', $this->year())
        ->where('classe_users.user_id', $this->users())
        ->distinct()
        ->orderBy('classes.level_id', 'asc')
        ->get();
        return $datas;
    }

    private function getTypeEvaluated(){
        $dts = EvaluadetType::orderBy('id')->get();
        return $dts;
    }

    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }

    private function users(){
        $user = Auth::user();
        return $user->id;
    }
}
