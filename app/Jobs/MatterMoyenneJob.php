<?php

namespace App\Jobs;

use App\Models\MatterMoyenne;
use App\Models\CuttingSchoolYear;
use App\Jobs\MoyenneAnnuelJobMatter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MatterMoyenneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $data = ClassementStudent($this->calculMoyenne());
        foreach($data as $item){
            $exist = MatterMoyenne::where('inscriptif_id', $item['id'])->where('discipline_level_id', $this->matter)->where('cutting_school_year_id', $this->cutting)->first();
            if($exist){
                $exist->update([
                    'rang' => $item['rang'],
                    'moyenne' => $item['moyen']
                ]);
            }
            else{
                $this->saveMoyenne($item['moyen'], $item['rang'], $item['id']);
            }
        }

        // Verification Du  decoupage
        $this->yearActif() ? MoyenneAnnuelJobMatter::dispatch($this->getStudent(), $this->matter, $this->yearActif()):null;
    }


    private function calculMoyenne(){
        $table = [];
        $student = $this->getStudent();
        foreach($student as $item){
            $valuated = $this->getNotEvaluated($item->id);
            $table[] = [
                'id' => $item->id,
                'genre' => $item->genre,
                'moyen' => calculMatterMoyenne($valuated)
            ];
        }
        return $table;
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
        $data = DB::table('evuluateds')
        ->join('evaluated_notes', 'evuluateds.id', '=', 'evaluated_notes.evuluated_id')
        ->join('inscriptifs', 'inscriptifs.id', '=', 'evaluated_notes.inscriptif_id')
        ->select('evaluated_notes.valeur', 'evuluateds.value')
        ->where('evaluated_notes.inscriptif_id', '=', $student)
        ->where('evuluateds.cutting_school_year_id', '=', $this->cutting)
        ->where('evuluateds.discipline_level_id', '=', $this->matter)
        ->where('evuluateds.classe_id', '=', $this->classe)
        ->where('evuluateds.actif', '=', '1')
        ->orderBy('evuluateds.created')->get();
        return $data;
    }


    private function saveMoyenne($moyen, $rang, $item) {
        MatterMoyenne::create([
            'rang' => $rang,
            'moyenne' => $moyen,
            'inscriptif_id' => $item,
            'discipline_level_id' => $this->matter,
            'cutting_school_year_id' => $this->cutting
        ]);
    }
    

    private function yearActif() {
        $val = CuttingSchoolYear::find($this->cutting);
        return $val->cutting->end ? $val->school_year_id:null;
    }
}
