<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classe;
use App\Models\Moyenne;
use APP\Models\SchoolYear;
use App\Models\CuttingSchoolYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.resultats.index');
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
    public function result($str)
    {
        try{
            list($id1, $id2) = explode('_', $str, 2);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $dats = $this->getMoyenneStudent($id1, $id2);
            return view('pages.resultats.resultat',[
                'dats' => $dats,
                'classe' => $class,
                'cutting' => $cutting,
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
    public function show(Request $request)
    {
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'cutting' => 'required|string',
            ]);
            $classe = Classe::find($val['class']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            return view('pages.resultats.detail',[
                'classe' => $classe,
                'cutting' => $cutting
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
    public function generate()
    {
        try{
            $class = Classe::find(4);
            $cutting = CuttingSchoolYear::find(1);
            $name = 'bulletin_'.$class->libelle;
            $pdf = PDF::loadView('pages.resultats.pdf.bulletin_1',[
                'classe' => $class,
                'cutting' => $cutting,
                'school' => School::first(),
            ])->setPaper('A3', 'portrait');// ou 'A4', 'A3', etc.
            return $pdf->stream($name.'.pdf');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getMoyenneStudent($class, $cutting){
        $student = $this->getStudent($class);
        $table = [];
        foreach($student as $item){
            $table[] = [
                'id' => $item['id'],
                'genre' => $item['genre'],
                'matricule' => $item['matricule'],
                'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
                'moyen' => Moyenne::where('inscriptif_id', $item['id'])->where('cutting_school_year_id', $cutting)->first()
            ];
        }
        return $table;
    }


    private function getStudent($class){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', '=', $class)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return json_decode($data, true);
    }


    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
