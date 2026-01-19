<?php

namespace App\Exports;

use App\Models\Classe;
use App\Models\CuttingSchoolYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ConduiteExport implements FromView
{
    
    protected $classe, $cutting;
    public function __construct($classe, $cutting)
    {
        $this->classe = $classe;
        $this->cutting = $cutting;
    }


    public function View(): View
    {
        $classe = Classe::find($this->classe);
        $cutting = CuttingSchoolYear::find($this->cutting);
        return view('pages.conduite.download.index',[
            'students' => $this->getStudent(),
            'cutting' => $cutting,
            'classe' => $classe
        ]);
    }


    private function getStudent(){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', $this->classe)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }
}

