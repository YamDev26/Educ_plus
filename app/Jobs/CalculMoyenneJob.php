<?php

namespace App\Jobs;

use App\Models\Moyenne;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculMoyenneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $classe, $cutting;
    public function __construct($classe, $cutting)
    {
        $this->classe = $classe;
        $this->cutting = $cutting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dts = ClassementStudent($this->getMoyenne());
        foreach($dts as $item){
            $exist = Moyenne::where('inscriptif_id', $item['id'])->where('cutting_school_year_id', $this->cutting)->first();
            if(!$exist){
                Moyenne::create([
                    'rang' => $item['rang'],
                    'total' => $item['point'],
                    'moyenne' => $item['moyen'],
                    'coefficient' => $item['coeff'],
                    'inscriptif_id' => $item['id'],
                    'cutting_school_year_id' => $this->cutting
                ]);
            }
            else{
                $exist->update([
                    'rang' => $item['rang'],
                    'total' => $item['point'],
                    'moyenne' => $item['moyen'],
                ]);
            }
        }
    }


    private function getMoyenne(){
        $tabeau = []; $stdts = $this->getStudent();
        foreach (  $stdts as $item) {
            $val = $this->calculMoyenne($item->id);
            $tabeau[] = [
                'id' => $item->id,
                'genre' => $item->genre,
                'moyen' => $val['moyen'],
                'point' => $val['point'],
                'coeff' => $val['coeff']
            ];
        }
        return $tabeau;
    }

    private function getStudent(){
        $dts = DB::table('inscriptifs')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.genre', 'inscriptifs.id')
        ->where('inscriptifs.classe_id', $this->classe)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $dts ?? null;
    }


    private function calculMoyenne($student){
        $matters = $this->getMatter($student);
        $total = 0; $coef = 0; $exist = false;
        foreach($matters as $item){
            if($item->moyenne != 'nc'){
                $total += ($item->moyenne * $item->coefficient); $coef += $item->coefficient; $exist = true;
            }
        }
        $moyen = $exist ? ($total ? number_format(($total / $coef), 2, '.', ' '):'0'):'nc';
        return ['point' => $total, 'coeff' => $coef, 'moyen' => $exist ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen];
    }


    private function getMatter($student){
        $data = DB::table('discipline_levels')
        ->join('matter_moyennes', 'discipline_levels.id', '=', 'matter_moyennes.discipline_level_id')
        ->join('approveds', 'discipline_levels.id', '=', 'approveds.discipline_level_id')
        ->select('discipline_levels.id', 'discipline_levels.coefficient', 'matter_moyennes.moyenne')
        ->where('approveds.cutting_school_year_id', $this->cutting)
        ->where('matter_moyennes.inscriptif_id', $student)
        ->where('approveds.classe_id', $this->classe)->get();
        return $data ?? null;
    }
}
