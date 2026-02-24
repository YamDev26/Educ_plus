<?php

namespace App\Jobs;

use App\Models\StatistikMatter;
use App\Jobs\CalculMoyenneJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculMoyenneClasseMatter implements ShouldQueue
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
        $exist = StatistikMatter::where('classe_id', $this->classe)->where('discipline_level_id', $this->matter)->where('cutting_school_year_id', $this->cutting)->first();
        if($exist){
            $exist->update([
                'moyenne' => $this->calculMoyenneClasse(),
                'taux_reussite' => $this->tauxSuccess(),
                'taux_echec' => $this->tauxFailure()
            ]);
        }
        else{
            StatistikMatter::create([
                'moyenne' => $this->calculMoyenneClasse(),
                'taux_reussite' => $this->tauxSuccess(),
                'taux_echec' => $this->tauxFailure(),
                'classe_id' => $this->classe,
                'discipline_level_id' => $this->matter,
                'cutting_school_year_id' => $this->cutting
            ]);
        }
        // Déclenchement de job pour le calcul de moyenne
        CalculMoyenneJob::dispatch($this->classe, $this->cutting);
    }


    private function calculMoyenneClasse(){
        $dts = $this->getStudent();
        $tatol = $dts->where('moyenne', '!=','nc')->sum('moyenne');
        $nbre = $dts->where('moyenne', '!=','nc')->count();;
        $moyen = $tatol ? number_format(($tatol / $nbre), 2, '.', ' '):'nc';
        return $tatol ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;
    }


    private function tauxSuccess(){
        $dts = $this->getStudent();
        $tatol = $dts->where('moyenne', '!=','nc')->where('moyenne', '>=','10')->count();
        $nbre = $dts->where('moyenne', '!=','nc')->count();
        return $this->formatNbre(($tatol / $nbre) * 100);
    }


    private function tauxFailure(){
        $dts = $this->getStudent();
        $tatol = $dts->where('moyenne', '!=','nc')->where('moyenne', '<','10')->count();
        $nbre = $dts->where('moyenne', '!=','nc')->count();
        return $this->formatNbre(($tatol / $nbre) * 100);
    }


    private function getStudent(){
        $data = DB::table('matter_moyennes')
        ->join('inscriptifs', 'inscriptifs.id', '=', 'matter_moyennes.inscriptif_id')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.genre', 'matter_moyennes.moyenne')
        ->where('matter_moyennes.cutting_school_year_id', $this->cutting)
        ->where('matter_moyennes.discipline_level_id', $this->matter)
        ->where('inscriptifs.classe_id', $this->classe)->get();
        return $data;
    }


    private Function formatNbre($valeur){
        if(isset($valeur) && $valeur < 100){
            $format = number_format($valeur, 2, '.', ' ');
            $valeur = $format < 10 ? '0'.$format:$format; 
        }
        return $valeur;
    }
}
