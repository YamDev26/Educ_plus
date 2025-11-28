<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\School;
use App\Models\Student;
use App\Models\Inscriptif;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Events\InscriptionEvent;
use Yajra\DataTables\DataTables;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.inscription.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function getData()
    {
        // $query = Inscriptif::where('school_year_id', $this->yearActif())->orderBy('created_at', 'desc')->get();
        return DataTables::of(Inscriptif::query())
            ->addColumn('student', function ($data) {
                $url = asset("assets/images/avatars/avatar-7.png");
                return ('<div class="d-flex align-items-center">
                    <div class="">
                        <img src="'.$url.'" class="rounded-circle" width="46" height="46" alt="">
                    </div>
                    <div class="ms-2">
                        <h6 class="mb-1 font-14">'.strtoupper($data->student->first_name).' '.ucwords($data->student->last_name).'</h6>
                        <p class="mb-0 font-13">'.strtoupper($data->student->genre).' - '.$data->student->matricule.'</p>
                    </div>
                </div>');
            })
            ->addColumn('classe', function ($data) {
                return ('<div class="pt-3 font-14 text-center">'.$data->classe->libelle.'</div>');
            })
            ->addColumn('created', function ($data) {
                return ('<div class="pt-3 font-14 text-center">'.date('d/m/Y', strtotime($data->created_at)).'</div>');
            })
            ->addColumn('action', function ($data) {
                return ('<div class="text-center">
					<a href="#" type="button" class="btn btn-sm btn-light mx-1" title="Fiche en pdf"><i class="lni lni-write me-0"></i></a>
                    <button type="button" class="btn btn-sm btn-light mx-1" data-id="'.$data->id.'" title="Annulation"><i class="lni lni-trash me-0"></i></button>
                </div>');
            })
            ->filterColumn('student', function($data, $keyword) {
                $data->whereHas('student', function($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('student', function($data, $keyword) {
                $data->whereHas('student', function($q) use ($keyword) {
                    $q->where('last_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('student', function($data, $keyword) {
                $data->whereHas('student', function($q) use ($keyword) {
                    $q->where('matricule', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('classe', function($data, $keyword) {
                $data->whereHas('classe', function($q) use ($keyword) {
                    $q->where('libelle', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['student', 'classe', 'created', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $data = Student::where('matricule', $request['matricule'])->first();
            if($data){
                $exist = Inscriptif::where('student_id', $data['id'])->first();
            }
            $status = $data ? 200:201;
            $std = [
                'name' => strtoupper($data['first_name']).' '.ucwords($data['last_name']), 
                'sexe' => strtoupper($data['genre']),
                'date' => date('d/m/Y', strtotime($data['date_naiss'])),
                'lieu' => ucwords($data['lieu_naiss']),
                'matricule' => $data['matricule'],
                'id' => $data['id'],
            ];
            return Response()->json([
                'status' => $status,
                'student' => $std,
                'classe' => $exist ? $exist['classe']['libelle']:null,
                'levels' => $this->getLevel()
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
                'id' => 'required|integer',
                'level' => 'required|integer',
                'classe' => 'required|integer',
                'affected' => 'required|string',
                'redoublant' => 'required|string',
                'bourse' => 'required|string',
                'lv2' => 'nullable|string',
                'serie' => 'nullable|integer',
            ]);
            $exist = Inscriptif::where('student_id', $val['id'])->where('school_year_id', $this->yearActif())->count();
            if(!$exist){
                event(new InscriptionEvent($val['id'], $val['affected'], $val['redoublant'], $val['bourse'], $val['classe'], $this->yearActif(), $val['lv2'], 'p/d', 'a definir', 'a definir'));
                return back()->with([
                    'str' => 'success',
                    'msg' => 'Inscription effectuée.'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Tentative de duplication d\'inscription.'
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


    private function getLevel(){
        $school = $this->school();
        $levels = Level::orWhere('college', $school['college'])->orWhere('lycee', $school['lycee'])->orderBy('id')->get();
        return $levels;
    }

    private function yearActif(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }

    private function school(){
        $school = School::first();
        return $school;
    }
}
