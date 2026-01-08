<?php

namespace App\Jobs;

use App\Models\Classe;
use App\Models\SubMatterMoyenne;
use App\Jobs\CalculMoyenneFrcsCycle1;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SubMatterMoyenneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $classe, $sub_matter, $cutting, $matter;
    public function __construct($classe, $sub_matter, $cutting, $matter)
    {
        $this->classe = $classe;
        $this->sub_matter = $sub_matter;
        $this->cutting = $cutting;
        $this->matter = $matter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = ClassementStudent($this->calculMoyenne());
        foreach($data as $item){
            $exist = SubMatterMoyenne::where('inscriptif_id', $item['id'])->where('sub_matter_id', $this->sub_matter)->where('cutting_school_year_id', $this->cutting)->first();
            if($exist){
                $exist->update([
                    'rang' => $item['rang'],
                    'moyenne' => $item['moyen'],
                    'value' => $this->getCoeff()
                ]);
            }
            else{
                $this->saveMoyenne($item['moyen'], $item['rang'], $item['id']);
            }
        }
        // Déclenchement de Jobs Pour Calcul De Moyenne Français Cycle 1
        CalculMoyenneFrcsCycle1::dispatch($this->classe, $this->matter, $this->cutting);
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
        ->where('evuluateds.sub_matter_id', '=', $this->sub_matter)
        ->where('evuluateds.classe_id', '=', $this->classe)
        ->where('evuluateds.actif', '=', '1')
        ->orderBy('evuluateds.created')->get();
        return $data;
    }


    private function saveMoyenne($moyen, $rang, $item){
        SubMatterMoyenne::create([
            'rang' => $rang,
            'moyenne' => $moyen,
            'value' => $this->getCoeff(),
            'inscriptif_id' => $item,
            'sub_matter_id' => $this->sub_matter,
            'cutting_school_year_id' => $this->cutting
        ]);
    }


    private function getCoeff(){
        $class = Classe::find($this->classe);
        if(in_array($class['level_id'], [3,4]) && $this->sub_matter == 1){
            $val = 2;
        }
        return $val ?? 1;
    }
}
