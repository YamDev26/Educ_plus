<?php

namespace App\Exports;

use App\Models\Evuluated;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EvaluatedExport implements FromView
{
    
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }


    public function View(): View
    {
        $eval = Evuluated::find($this->id);
        $students = $this->getStudent($eval->classe_id);
        return view('pages.evaluated.download.index',[
            'students' => $students,
            'evaluated' => $eval
        ]);
    }


    private function getStudent($class){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', '=', $class)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }
}
