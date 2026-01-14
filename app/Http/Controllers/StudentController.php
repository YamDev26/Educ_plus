<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\School;
use App\Models\Student;
use App\Models\ParentStd;
use App\Models\SchoolYear;
use App\Models\Inscriptif;
use App\Models\Nationality;
use App\Models\BiologicalStd;
use App\Exports\StudentExport;
use App\Events\InscriptionEvent;
use App\Http\Requests\CreateStudent;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\StudentNewImport;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.students.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    public function data(){
        $query = Student::where('status', '1')->orderBy('first_name')->orderBy('last_name');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('student', function ($data) {
            $url = asset($data->genre == "F" ? "assets/images/avatars/std_woman.png":"assets/images/avatars/std_man.png");
            return ('<div class="d-flex align-items-center">
                <div class="">
                    <img src="'.$url.'" class="rounded-circle" width="46" height="46" alt="image student" style="border: 1px solid">
                </div>
                <div class="ms-2">
                    <h6 class="mb-1 font-14">'.strtoupper($data->first_name).' '.ucwords($data->last_name).'</h6>
                    <p class="mb-0 font-13">'.strtoupper($data->genre).' - '.$data->matricule.'</p>
                </div>
            </div>');
        })
        ->addColumn('dateNaiss', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">Né'.($data->genre == 'F' ? 'e':'').' le '.date('d/m/Y', strtotime($data->date_naiss)).'</h6>
                <p class="mb-0 font-13">à '.ucwords($data->lieu_naiss).'</p>
            </div>');
        })
        ->addColumn('parent', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">'.strtoupper($data->parent_std->first).' '.ucwords($data->parent_std->last).'</h6>
                <p class="mb-0 font-13">'.$data->parent_std->phon1.' '.($data->parent_std->phon2 ? ' / '.$data->parent_std->phon2:null).'</p>
            </div>');
        })
        ->addColumn('action', function ($data) {
            $edit = route('student.edit',$data->id);
            $show = route('student.show',$data->id);
            return ('<div class="pt-2 d-flex justify-content-center">
                <a href="'.$show.'" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px"><i class="bx bx-show-alt mx-0" style="font-size: 19px"></i></a>
                <a href="'.$edit.'" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px"><i class="bx bx-edit mx-0" style="font-size: 19px"></i></a>
            </div>');
        })
        ->filterColumn('student', function($query, $keyword) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name, ' ', matricule, ' ', genre) like ?", ["%$keyword%"]);
        })
        ->filterColumn('dateNaiss', function($query, $keyword) {
            $query->whereRaw("CONCAT(date_naiss, ' ', lieu_naiss) like ?", ["%$keyword%"]);
        })
        ->filterColumn('parent', function($data, $keyword) {
            $data->whereHas('parent_std', function($q) use ($keyword) {
                $q->where('first', 'like', "%{$keyword}%");
            });
        })
        ->filterColumn('parent', function($data, $keyword) {
            $data->whereHas('parent_std', function($q) use ($keyword) {
                $q->where('last', 'like', "%{$keyword}%");
            });
        })
        ->rawColumns(['counter', 'student', 'dateNaiss', 'parent', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('pages.students.create', [
                'data' => [],
                'levels' => $this->getLevel(),
                'oldLevel' => $this->oldLevel()
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
     * Store a newly create resource in storage.
     */
    public function store(CreateStudent $request)
    {
        try{
            $request->Validated();
            $parent = $this->parents($request['nameFirstParent'], $request['nameLastParent'], $request['phon1'], $request['phon2'], $request['profesionParent'], $request['email']);
            $nation = $this->nationalite($request['nationalite']);
            $biol = $this->biological($request['pereNameFirst'], $request['pereNameLast'], $request['phonPere'], $request['profPere'], $request['mereNameFirst'], $request['mereNameLast'], $request['phonMere'], $request['profMere']);
            $student = $this->student($request['matricule'], $request['firstName'], $request['lastName'], $request['genre'], $request['dateNaiss'], $request['lieuNaiss'], $request['extrait'], $nation, $request['residence'], $request['file'], $parent, $biol);
            $exist = Inscriptif::where('student_id', $student)->where('school_year_id', $this->yearActif())->count();
            if(!$exist){
                event(new InscriptionEvent($student, $request['affecte'], $request['doublant'], $request['boursier'], $request['classe'], $this->yearActif(), $request['lv2'], $request['interne'], $request['oldLevel'], strtolower($request['oldSchool'])));
                return to_route('student.index')->with([
                    'str' => 'success',
                    'msg' => 'Inscriptition effectué.'
                ]);
            }
            else{
                return to_route('student.index')->with([
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
            $data = Student::find($id);
            return view('pages.students.detail',[
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
        try{
            $data = Student::find($id);
            return view('pages.students.edit',[
                'data' => $data,
                'levels' => $this->getLevel(),
                'oldLevel' => $this->oldLevel()
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
            $request->validate([
                'phon1' => 'required|numeric|min:10',

            ]);

            $student = Student::find($id);
            if($student){
                if($request['file']){
                    $request->validate(['file' => 'image|mimes:jpg,png,jpeg']);
                    if ($student->image && Storage::exists('app/public/student/'.$student->image)) {
                        Storage::delete('app/public/student/'.$student->image);
                    }
                }
                $parent = $this->parents($request['nameFirstParent'], $request['nameLastParent'], $request['phon1'], $request['phon2'], $request['profesionParent'], $request['email'], $student['parent_std_id']);
                $nation = $this->nationalite($request['nationalite']);
                $biol = $this->biological($request['pereNameFirst'], $request['pereNameLast'], $request['phonPere'], $request['profPere'], $request['mereNameFirst'], $request['mereNameLast'], $request['phonMere'], $request['profMere'], $student['biological_std_id']);
                $this->student($request['matricule'], $request['firstName'], $request['lastName'], $request['genre'], $request['dateNaiss'], $request['lieuNaiss'], $request['extrait'], $nation, $request['residence'], $request['file'], $parent, $biol, $id);
                return to_route('student.show', $id)->with([
                    'str' => 'info',
                    'msg' => 'Modification effectuée.'
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
                'msg' => 'Une erreur est survenue !'.$e->getMessage()
            ]);
        }
    }


    public function export()
    {
        try{
             $str = Str::upper(Str::random(2));
            $name = 'file_new_student_'.$str.'_'.$this->yearActif();
            return Excel::download(new StudentExport(), $name.'.xlsx');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function import(Request $request)
    {
        try{
            $request->validate([
                'files' => 'required|file|mimes:xlsx|max:2048'
            ]);
            $file = $request->file('files');
            list($name, $extent) = explode('.', $file->getClientOriginalName());
            $explod = explode('_', $name);
            $year = $this->yearActif();
            if(count($explod) && $explod[4] == $year){
                Excel::import(new StudentNewImport($explod[4]), $file);
                return back()->with([
                    'str' => 'success',
                    'msg' => 'Importation réussie avec success.'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Mauvais fichier importé.'
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function parents($first, $last = null, $phon1, $phon2 = null, $prof = null, $email = null, $id = null){
        if($id){
            ParentStd::where('id', $id)->update([
                'first' => strtolower($first),
                'last' => strtolower($last),
                'phon1' => $phon1,
                'phon2' => $phon2,
                'email' => $email,
                'profession' => strtolower($prof)
            ]);
        }
        else{
            $dts = ParentStd::where('phon1', $phon1)->orWhere('phon2', $phon1)->first();
            if(!$dts){
                $query = $phon2 ? ParentStd::where('phon1', $phon2)->orWhere('phon2', $phon2)->first():null;
                $dts = $query ?? ParentStd::create([
                    'first' => strtolower($first),
                    'last' => strtolower($last),
                    'phon1' => $phon1,
                    'phon2' => $phon2,
                    'email' => $email,
                    'profession' => strtolower($prof)
                ]);
            }
        }
        return $id ?? ($dts ? $dts->id:null);
    }

    private function nationalite($libelle){
        $dts = Nationality::where('libelle', 'like', "%{$libelle}%")->first();
        if(!$dts){
            $dts = Nationality::create([
                'libelle' => strtolower($libelle)
            ]);
        }
        return $dts ? $dts->id:null;
    }

    private function biological($firstFt = null, $lastFt = null, $phonFt = null, $jobFt = null, $firstMt = null, $lastMt = null, $phonMt = null, $jobMt = null, $id = null){
        if($id){
            BiologicalStd::where('id', $id)->update([
                'first_father' => strtolower($firstFt),
                'last_father' => strtolower($lastFt),
                'prof_father' => strtolower($jobFt),
                'phon_father' => $phonFt,
                'first_mother' => strtolower($firstMt),
                'last_mother' =>  strtolower($lastMt),
                'prof_mother' => strtolower($jobMt),
                'phon_mother' => $phonMt
            ]);
        }
        else{
            $dts = BiologicalStd::where('phon_father', $phonFt)->where('phon_mother', $phonMt)->first();
            if(!$dts){
                $dts = BiologicalStd::create([
                    'first_father' => strtolower($firstFt),
                    'last_father' => strtolower($lastFt),
                    'prof_father' => strtolower($jobFt),
                    'phon_father' => $phonFt,
                    'first_mother' => strtolower($firstMt),
                    'last_mother' =>  strtolower($lastMt),
                    'prof_mother' => strtolower($jobMt),
                    'phon_mother' => $phonMt
                ]);
            }
        }
        return $id ?? ($dts ? $dts->id:null);
    }

    private function student($matrcule, $first, $last, $genre, $date, $lieu, $extrait = null, $pays, $residence, $photo = null, $parent1, $parent2 = null, $id = null){
        if($id){
            Student::where('id', $id)->update([
                'matricule' => $matrcule,
                'first_name' => strtolower($first),
                'last_name' => strtolower($last),
                'genre' => $genre,
                'date_naiss' => $date,
                'lieu_naiss' => strtolower($lieu),
                'num_extrait' => strtolower($extrait),
                'residence' => strtolower($residence),
                'image' => $photo ? $this->upload($photo,$matrcule):null,
                'parent_std_id' => $parent1,
                'nationalitie_id' => $pays,
                'biological_std_id' => $parent2,
            ]);
        }
        else{
            $dts = Student::where('matricule', $matrcule)->first();
            if(!$dts){
                $dts = Student::create([
                    'matricule' => $matrcule,
                    'first_name' => strtolower($first),
                    'last_name' => strtolower($last),
                    'genre' => $genre,
                    'date_naiss' => $date,
                    'lieu_naiss' => strtolower($lieu),
                    'num_extrait' => strtolower($extrait),
                    'residence' => strtolower($residence),
                    'image' => $photo ? $this->upload($photo,$matrcule):null,
                    'parent_std_id' => $parent1,
                    'nationalitie_id' => $pays,
                    'biological_std_id' => $parent2,
                    'school_year_id' => $this->yearActif(),
                ]);
            }
            return $dts ? $dts->id:null;
        }
    }


    /** @var UploadedFile $img */ 
    private function upload($file, $matricule){
        $name = $matricule.'.png';
        $lien = $file->storeAs('student', $name, 'public');
        return $lien;
    }

    private function getLevel(){
        $school = $this->school();
        $levels = Level::orWhere('college', $school['college'])->orWhere('lycee', $school['lycee'])->orderBy('id')->get();
        return $levels;
    }

    private function oldLevel(){
        return ['CM2', '6eme', '5eme', '4eme', '3eme', '2nde', '1ere', 'Tle'];
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