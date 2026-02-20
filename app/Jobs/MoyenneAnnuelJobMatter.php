<?php

namespace App\Jobs;

use App\Models\MatterMoyenne;
use App\Models\CuttingSchoolYear;
use App\Models\MoyenneAnnuelMatter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MoyenneAnnuelJobMatter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student, $matter, $year;
    public function __construct($student, $matter, $year) {
        $this->student = $student;
        $this->matter = $matter;
        $this->year = $year;
    }

    
    public function handle(): void
    {
        $data = ClassementStudent($this->calculMoyenne());
        foreach($data as $item){
            $exist = MoyenneAnnuelMatter::where('inscriptif_id', $item['id'])->where('discipline_level_id', $this->matter)->where('school_year_id', $this->year)->first();
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
    }



    private function calculMoyenne() {
        $table = [];
        foreach($this->student as $item){
            $table[] = [
                'id' => $item->id,
                'genre' => $item->genre,
                'moyen' => $this->moyenne($item->id)
            ];
        }
        return $table;
    }

    
    private function moyenne($item) {
        $cutting = $this->getCutting();
        $coef = 0; $nbre = 0; $exist = false;
        foreach($cutting as $val){
            $query = $this->getVal($item, $val->id);
            if($query && $query != 'nc'){
                $nbre += ($query * $val->cutting->valeur); // Moyenne multipliée par le coefficient du decoupage
                $coef += $val->cutting->valeur;
                $exist = true;
            }
        }

        // Calcul moyenne -------
        $moyen = $exist ? ($nbre ? number_format(($nbre / $coef), 2, '.', ' '):'0'):'nc';
        return $exist ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;
    }


    private function getCutting() {
        $val = CuttingSchoolYear::where('school_year_id', $this->year)->get();
        return $val;
    }


    private function getVal($id1, $id2) {
        $val = MatterMoyenne::where('inscriptif_id', $id1)->where('discipline_level_id', $this->matter)->where('cutting_school_year_id', $id2)->first();
        return $val ? $val->moyenne:null;
    }


    private function saveMoyenne($item, $rang, $moyen) {
        MoyenneAnnuelMatter::create([
            'rang' =>$rang,
            'moyenne' => $moyen,
            'inscriptif_id' => $item,
            'school_year_id' => $this->year,
            'discipline_level_id' => $this->matter
        ]);
    }
}
