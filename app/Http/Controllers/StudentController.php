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
use App\Events\InscriptionEvent;
use App\Http\Requests\CreateStudent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $students = Student::where('status', '1')->orderBy('first_name')->orderBy('last_name')->paginate(10);
            return view('pages.students.index',[
                'students' => $students
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

    private function parents($first, $last = null, $phon1, $phon2 = null, $prof, $email = null){
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
        return $dts ? $dts->id:null;
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

    private function biological($firstFt = null, $lastFt = null, $phonFt = null, $jobFt = null, $firstMt = null, $lastMt = null, $phonMt = null, $jobMt = null){
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
        return $dts ? $dts->id:null;
    }

    private function student($matrcule, $first, $last, $genre, $date, $lieu, $extrait = null, $pays, $residence, $photo = null, $parent1, $parent2 = null){
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
