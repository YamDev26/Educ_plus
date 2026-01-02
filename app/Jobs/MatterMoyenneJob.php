<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class MatterMoyenneJob implements ShouldQueue
{
    use Queueable;

    protected $classe, $matter, $cutting;
    public function __construct($classe, $matter, $cutting)
    {
        $this->classe = $classe;
        $this->matter = $matter;
        $this->cutting = $cutting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }


    private function calculMoyenne(){
        $table = [];
        $student = $this->getStudent();
        foreach($student as $item){
            $valuated = $this->getNotEvaluated($item['id']);
            $table[] = [
                'id' => $item['id'],
                'genre' => $item['genre'],
                'moyen' => calculMatterMoyenne($valuated)
            ];
            return $table;
        }
    }


    private function getStudent(){
        $data = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.matricule', 'students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', '=', $this->classe)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }


    private function getNotEvaluated($student){
        $data = DB::TABLE('evuluateds')
        ->join('evaluated_notes', 'evuluateds.id', '=', 'evaluated_notes.evaluation_id')
        ->join('inscriptifs', 'inscriptifs.id', '=', 'evaluated_notes.inscriptif_id')
        ->select('evaluated_notes.valeur', 'evuluateds.value')
        ->where('evaluated_notes.inscription_id', '=', $student)
        ->where('evuluateds.cutting_school_year_id', '=', $this->cutting)
        ->where('evuluateds.level_matter_id', '=', $this->matter)
        ->where('evuluateds.classe_id', '=', $this->classe)
        ->where('evuluateds.actif', '=', '1')
        ->orderBy('evuluateds.created')->get();
        return $data;
    }
      
}
