<?php

namespace App\Jobs;

use App\Jobs\CalculStatistikLevelJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculStatistikClasseJob implements ShouldQueue
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
        // dd($this->resultMascullin());

        // Déclenchement de job pour le calcul de moyenne
        CalculStatistikLevelJob::dispatch($this->classe, $this->cutting);
        
    }

    // Reeultat Classe
    private function resultatClasse(){
        $dts = $this->getStudent();
        $total = $dts->sum('moyenne');
        $nbre = $dts->count();

        // Moyenne de Classe
        $moyen = blank($total) ? 'nc':($total ? number_format(($total / $nbre), 2, '.', ' '):'0');
        $moyenCls = blank($total) ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;

        // Taux de Réussite de la CLasse
        $tlsPlus = $dts->where('moyenne', '>=','10')->count();
        $txPlus = $this->formatNbre($tlsPlus ? (($tlsPlus / $nbre) * 100):'00');
        
        // Taux d'Echec de la Classe
        $tlsMoins = $dts->where('moyenne', '<','10')->count();
        $txMoins = $this->formatNbre($tlsMoins ? (($tlsMoins / $nbre) * 100):'00');

        return [
            'moyen' => $moyenCls,
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins,
        ];
    }

    // Pourcentage Fille 
    private function resultFeminin(){
        $dts = $this->getStudent()->where('genre', 'F');
        $nbre = $dts->count();

        // Taux de Réussite de la CLasse
        $tlsPlus = $dts->where('moyenne', '>=','10')->count();
        $txPlus = $this->formatNbre($tlsPlus ? (($tlsPlus / $nbre) * 100):'00');
        
        // Taux d'Echec de la Classe
        $tlsMoins = $dts->where('moyenne', '<','10')->count();
        $txMoins = $this->formatNbre($tlsMoins ? (($tlsMoins / $nbre) * 100):'00');

        return [
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins
        ];
    }


    // Pourcentage Garçàn
    private function resultMascullin(){
        $dts = $this->getStudent()->where('genre', 'M');
        $nbre = $dts->count();

        // Taux de Réussite de la CLasse
        $tlsPlus = $dts->where('moyenne', '>=','10')->count();
        $txPlus = $this->formatNbre($tlsPlus ? (($tlsPlus / $nbre) * 100):'00');
        
        // Taux d'Echec de la Classe
        $tlsMoins = $dts->where('moyenne', '<','10')->count();
        $txMoins = $this->formatNbre($tlsMoins ? (($tlsMoins / $nbre) * 100):'00');

        return [
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins
        ];
    }


    private function getStudent(){
        $data = DB::table('moyennes')
        ->join('inscriptifs', 'inscriptifs.id', '=', 'moyennes.inscriptif_id')
        ->join('students', 'students.id', '=', 'inscriptifs.student_id')
        ->select('students.genre', 'moyennes.moyenne')
        ->where('moyennes.cutting_school_year_id', $this->cutting)
        ->where('inscriptifs.classe_id', $this->classe)
        ->where('moyennes.moyenne' ,'!=', 'nc')->get();
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
