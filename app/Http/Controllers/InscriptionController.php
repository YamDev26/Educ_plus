<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Classe;
use App\Models\School;
use App\Models\Student;
use App\Models\Inscriptif;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Events\InscriptionEvent;
use Yajra\DataTables\DataTables;
use App\Exports\InscriptionExport;
use App\Imports\InscriptionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use PDF;

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
        $counter = 0;
        return DataTables::of(Inscriptif::orderByDesc('created_at'))
            ->addColumn('student', function ($data) {
                $url = asset($data->student->genre == "F" ? "assets/images/avatars/std_woman.png":"assets/images/avatars/std_man.png");
                return ('<div class="d-flex align-items-center">
                    <div class="">
                        <img src="'.$url.'" class="rounded-circle" width="46" height="46" alt="image studen" style="border: 1px solid">
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
                $url = route('inscription.show',$data->id);
                return ('<div class="my-0 order-actions d-flex justify-content-center">
					<a href="'.$url.'" target="_blank" class="mt-1 btn"><i class="bx bxs-file-pdf font-20 mx-0"></i></a>
                    <button class="ms-2 mt-1 btn btnDelete" data-id="'.$data->id.'"><i class="bx bx-trash font-20 mx-0"></i></button>
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
            ->addColumn('counter', function() use (&$counter) {
                return $counter < 9 ? '0'.++$counter : ++$counter;
            })
            ->rawColumns(['student', 'classe', 'created', 'action', 'counter'])
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
                $exist = Inscriptif::where('student_id', $data['id'])->where('school_year_id', $this->yearActif())->first();
                $std = [
                    'name' => strtoupper($data['first_name']).' '.ucwords($data['last_name']), 
                    'sexe' => strtoupper($data['genre']),
                    'date' => date('d/m/Y', strtotime($data['date_naiss'])),
                    'lieu' => ucwords($data['lieu_naiss']),
                    'matricule' => $data['matricule'],
                    'url' => asset($data['genre'] == "F" ? "assets/images/avatars/std_woman.png":"assets/images/avatars/std_man.png"),
                    'id' => $data['id'],
                ];
            }
            return Response()->json([
                'status' => $data ? 200:201,
                'student' => $data ? $std:null,
                'levels' => $data ? $this->getLevel():null,
                'classe' => $data ? ($exist ? $exist['classe']['libelle']:null):null,
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function search()
    {
        try{
            return Response()->json($this->getLevel());
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function export(Request $request)
    {
        try{
            $val = $request->validate([
                'level' => 'required|string',
                'classe' => 'required|string'
            ]);
            $classe = Classe::find($val['classe']);
            $str = Str::upper(Str::random(2));
            $name = 'file_inscription_'.$str.'_'.$classe->libelle.'_'.$classe->id;
            return Excel::download(new InscriptionExport($classe->id), $name.'.xlsx');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function import(Request $request){
        try{
            $request->validate([
                'files' => 'required|file|mimes:xlsx|max:2048'
            ]);
            $file = $request->file('files');
            list($name, $extent) = explode('.', $file->getClientOriginalName());
            $str = explode('_', $name);
            $class = Classe::find($str[4]);
            
            if($class && ($str[3] == $class['libelle'])){
                Excel::import(new InscriptionImport($str[4]), $file);
                return back()->with([
                    'str' => 'success',
                    'msg' => 'Impotation réussite.'
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
        try{
            $pdf = PDF::loadView('pages.inscription.pdf.file_pdf');
            $pdf->setPaper('A4', 'portrait'); // ou 'A4', 'A3', etc.
            return $pdf->stream('fiche_'.$id.'.pdf');
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
    public function edit(Request $request)
    {
        try{
            $val = Inscriptif::find($request['id']);
            
            return response()->json([
                'name' => strtoupper($val->student->first_name).' '.ucwords($val->student->last_name),
                'matricule' => $val->student->matricule,
                'classe' => $val->classe->libelle,
                'date' => date('d/m/Y', strtotime($val->created_at)),
                'classId' => $val->classe_id,
                'id' => $val->id
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
    public function destroy(Request $request)
    {
        try{
            $val = Inscriptif::find($request['id']);
            if($val){
                $val->delete();
                $class = Classe::find($request['classId']);
                $class->update([
                    'inscrit' => ((int)$class['inscrit']-1)
                ]);
                 return back()->with([
                    'str' => 'info',
                    'msg' => 'Inscription annulée.'
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
     * Update the specified resource in storage.
     */
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
