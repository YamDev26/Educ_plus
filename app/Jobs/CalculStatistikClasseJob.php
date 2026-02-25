<?php

namespace App\Jobs;

use App\Models\Moyenne;
use App\Models\ClasseStatistik;
use App\Jobs\CalculStatistikLevelJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $exist = ClasseStatistik::where('classe_id', $this->classe)->where('cutting_school_year_id', $this->cutting)->first();
        if(!$exist){
            $this->saved();
        }
        else{
            $class = $this->resultatClasse();
            $feminin = $this->resultSexeFeminin();
            $masculin = $this->resultSexeMascullin();
            $exist->update([
                'moyenne' => $class['moyen'],
                'nbre_moyenne' => $class['nbreMoyenne'],
                'nbre_non_moyenne' => $class['nbreNonMoyenne'],
                'taux_echec' => $class['tauxEchec'],
                'taux_reussite' => $class['txReussite'],
                'nbre_moyenne_feminin' => $feminin['nbreMoyenne'],
                'nbre_non_moyenne_feminin' => $feminin['nbreNonMoyenne'],
                'taux_echec_feminin' => $feminin['tauxEchec'],
                'taux_reussite_feminin' => $feminin['txReussite'],
                'taux_feminin' => $feminin['taux'],
                'nbre_moyenne_masculin' => $masculin['nbreMoyenne'],
                'nbre_non_moyenne_masculin' => $masculin['nbreNonMoyenne'],
                'taux_echec_masculin' => $masculin['tauxEchec'],
                'taux_reussite_masculin' => $masculin['txReussite'],
                'taux_masculin' => $masculin['taux']
            ]);
        }

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
            'nbreMoyenne' => $tlsPlus,
            'nbreNonMoyenne' => $tlsMoins,
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins,
        ];
    }

    // Pourcentage Fille 
    private function resultSexeFeminin(){
        $dts = $this->getStudent()->where('genre', 'F');
        $nbreFeminin = $dts->count();

        // Taux de Réussite de la CLasse
        $tlsPlus = $dts->where('moyenne', '>=','10')->count();
        $txPlus = $this->formatNbre($tlsPlus ? (($tlsPlus / $nbreFeminin) * 100):'00');
        
        // Taux d'Echec de la Classe
        $tlsMoins = $dts->where('moyenne', '<','10')->count();
        $txMoins = $this->formatNbre($tlsMoins ? (($tlsMoins / $nbreFeminin) * 100):'00');

        // Pourcentage tatal
        $total = $this->getStudent()->count();
        $taux = $this->formatNbre($total ? (($nbreFeminin / $total) * 100):'00');

        return [
            'nbreMoyenne' => $tlsPlus,
            'nbreNonMoyenne' => $tlsMoins,
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins,
            'taux' => $taux,
        ];
    }


    // Pourcentage Garçàn
    private function resultSexeMascullin(){
        $dts = $this->getStudent()->where('genre', 'M');
        $nbreMasculin = $dts->count();

        // Taux de Réussite de la CLasse
        $tlsPlus = $dts->where('moyenne', '>=','10')->count();
        $txPlus = $this->formatNbre($tlsPlus ? (($tlsPlus / $nbreMasculin) * 100):'00');
        
        // Taux d'Echec de la Classe
        $tlsMoins = $dts->where('moyenne', '<','10')->count();
        $txMoins = $this->formatNbre($tlsMoins ? (($tlsMoins / $nbreMasculin) * 100):'00');

        // Pourcentage tatal
        $total = $this->getStudent()->count();
        $taux = $this->formatNbre($total ? (($nbreMasculin / $total) * 100):'00');

        return [
            'nbreMoyenne' => $tlsPlus,
            'nbreNonMoyenne' => $tlsMoins,
            'txReussite' => $txPlus,
            'tauxEchec' => $txMoins,
            'taux' => $taux
        ];
    }


    private function getStudent(){
        $data = Moyenne::join('inscriptifs', 'inscriptifs.id', '=', 'moyennes.inscriptif_id')
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

    private function saved(){
        $class = $this->resultatClasse();
        $feminin = $this->resultSexeFeminin();
        $masculin = $this->resultSexeMascullin();

        // Created Data 
        ClasseStatistik::create([
            'moyenne' => $class['moyen'],
            'nbre_moyenne' => $class['nbreMoyenne'],
            'nbre_non_moyenne' => $class['nbreNonMoyenne'],
            'taux_echec' => $class['tauxEchec'],
            'taux_reussite' => $class['txReussite'],
            'nbre_moyenne_feminin' => $feminin['nbreMoyenne'],
            'nbre_non_moyenne_feminin' => $feminin['nbreNonMoyenne'],
            'taux_echec_feminin' => $feminin['tauxEchec'],
            'taux_reussite_feminin' => $feminin['txReussite'],
            'taux_feminin' => $feminin['taux'],
            'nbre_moyenne_masculin' => $masculin['nbreMoyenne'],
            'nbre_non_moyenne_masculin' => $masculin['nbreNonMoyenne'],
            'taux_echec_masculin' => $masculin['tauxEchec'],
            'taux_reussite_masculin' => $masculin['txReussite'],
            'taux_masculin' => $masculin['taux'],
            'classe_id' => $this->classe,
            'cutting_school_year_id' => $this->cutting
        ]);
    }
}