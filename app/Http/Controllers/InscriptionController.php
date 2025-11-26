<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\School;
use App\Models\Student;
use App\Models\Inscriptif;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
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
        return DataTables::of(Student::query())
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-info text-center px-1 py-0 text-white" title="Detail"><i class="bx bx-show-alt m-0" style="font-size: 15px"></i></button>';
            })
            ->rawColumns(['action'])
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
            return Response()->json([
                'status' => $status,
                'classe' => $exist['classe']['libelle'],
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
