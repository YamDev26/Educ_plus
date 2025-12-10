<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Evuluated;
use App\Models\Inscriptif;
use App\Models\DisciplineLevel;
use App\Models\CuttingSchoolYear;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class EvaluatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.evaluated.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function dataTable(){
        $query = Classe::where('status', '1')->orderBy('level_id');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('inscrit', function ($row) {
            return $row->inscrit <= 9 ? '0'.$row->inscrit : $row->inscrit;
        })
        ->addColumn('action', function ($data) {
            return ('<div class="my-0 order-actions d-flex justify-content-center">
                <button data-id="'.$data->id.'" class="btn btn-outline-light py-0 px-1 addEvaluated"><i class="bx bx-grid-small font-20 mx-0"></i></button>
            </div>');
        })
        ->rawColumns(['counter', 'inscrit', 'action'])
        ->make(true);
    }


    public function search(Request $request){
        try{
            $class = Classe::find($request['id']);
            $data = $this->getMatters($class['level_id']);
            return Response()->json([
                'status' => $data ? 200:201,
                'data' => $data ?? null
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
    public function create(Request $request)
    {
        try{
            // dd(Evuluated::get());
            return to_route('evaluated.note', 2)->with([
                'str' => 'info',
                'msg' => 'Ajoutez les notes pour cette evaluation'
            ]);

            $val = $request->validate([
                'classe' => 'required|integer',
                'matter' => 'required|integer',
                'cutting' => 'required|integer',
                'type' => 'required|string',
                'values' => 'required|string',
                'date' => 'required|date',
            ]);
            $verify = $this->verifyEvaluated($val['classe'], $val['matter'], $val['cutting'], $val['type'], $val['values'], $val['date']);
            if(!$verify){
                $evaluated = Evuluated::create([
                    'type' => $val['type'],
                    'value' => $val['values'],
                    'created' => $val['date'],
                    'classe_id'  => $val['classe'],
                    'discipline_level_id'=> $val['matter'],
                    'cutting_school_year_id' => $val['cutting']
                ]);
                return to_route('evaluated.note', $evaluated['id'])->with([
                    'str' => 'info',
                    'msg' => 'Ajoutez les notes pour cette evaluation'
                ]);
            }
            else{
                return to_route('evaluated.back', $val['classe'].'_'.$val['matter'])->with([
                    'str' => 'warning',
                    'msg' => 'Evaluation déjà créée.'
                ]);
            }
        }
        catch (\Exception $e) {
            return to_route('evaluated.back', $val['classe'].'_'.$val['matter'])->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function addNote(string $str){
        try{
            $evaluated = Evuluated::find($str);
            $datas = Inscriptif::whereHas('student', function ($q){
                $q->orderBy('first_name')->orderBy('last_name');
            })->where('classe_id', $evaluated['classe_id'])
            ->get();

            return view('pages.evaluated.create',[
                'evaluated' => $evaluated,
                'students' => $datas
            ]);
        }
        catch (\Exception $e) {
            return to_route('evaluated.back','5_2')->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'.$e->getMessage()
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
    public function show(Request $request)
    {
        try{
            $val = $request->validate([
                'classId' => 'required|string',
                'matterId' => 'required|string',
            ]);
            $class = Classe::find($val['classId']);
            $matter = DisciplineLevel::find($val['matterId']);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'data' => $this->getEvaluated($class)
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function back(string $str){
        try{
            $explod = explode('_', $str);
            $class = Classe::find($explod[0]);
            $matter = DisciplineLevel::find($explod[1]);
            return view('pages.evaluated.show',[
                'classe' => $class,
                'matter' => $matter,
                'data' => $this->getEvaluated($class)
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

    private function getEvaluated($class){
        $data = CuttingSchoolYear::where('school_year_id', $class['school_year_id'])->get();
        $vals = ['successhome', 'successprofile', 'successcontact'];
        $table = []; $i = 0;
        foreach($data as $item){
            $table[] = [
                'id' => $item->id,
                'idTable' => $vals[$i],
                'status' => $item->status,
                'libelle' => $item->cutting->libelle,
                'evaluated' => []
            ];
            $i++;
        }
        return $table;
    }


    private function verifyEvaluated($classe, $matter, $cutting, $type, $value, $created){
        $count = Evuluated::where('classe_id', $classe)
        ->where('type', $type)
        ->where('value', '=', $value)
        ->where('created', '=', $created)
        ->where('discipline_level_id', $matter)
        ->where('cutting_school_year_id', $cutting)
        ->count();
        return $count;
    }

    private function getMatters($level){
        $data = DB::table('disciplines')
        ->join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
        ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat')
        ->where('discipline_levels.level_id', '=', $level)
        ->orderBy('disciplines.libelle')->get();
        return $data ?? null;
    }
}
