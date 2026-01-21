<?php

namespace App\Jobs;

use App\Models\absensTime;
use App\Jobs\SaveConduiteJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GestionCndteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $students, $moyens, $justifys, $injustifys, $matter, $cutting;
    public function __construct($students, $moyens, $justifys, $injustifys, $matter, $cutting)
    {
        $this->students = $students;
        $this->moyens = $moyens;
        $this->justifys = $justifys;
        $this->injustifys = $injustifys;
        $this->matter = $matter;
        $this->cutting = $cutting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {dd($this->students);
        $dts = $this->students; $moyen = $this->moyens;
        if(count($dts) == count($moyen)){
            if($this->moyenStudents()){
                $this->saveHeure($dts);
                // Déclenchement de job pour le calcul de moyenne   
                SaveConduiteJob::dispatch($this->moyenStudents(), $this->matter, $this->cutting)->delay(now()->addSeconds(2));
            }

        }
    }


    private function moyenStudents(){
        $dts = $this->students; $moyen = $this->moyens;
        $table = []; $i = 0;
        while($i < count($dts)){
            list($id, $sexe) = explode('_', $dts[$i]);
            $table[] = [
                'id' => $id,
                'genre' => $sexe,
                'moyen' => $this->moyen($moyen[$i])
            ];
            $i++;
        }
        return $table ?? null;
    }

    private function moyen($value){
        $moyen = blank($value) ? 'nc':((float)$value ? number_format(($value), 2, '.', ' '):'0');
        $moyen = ltrim($moyen, '0');
        return $moyen != 'nc' ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;
    }

    private function saveHeure($dts){
        $time1 = $this->justifys; $time2 = $this->injustifys; $i = 0;
        while($i < count($dts)){
            list($id, $sexe) = explode('_', $dts[$i]);
            $exist = absensTime::where('inscriptif_id', $id)->where('cutting_school_year_id', $this->cutting)->first();
            $exist ?
            $exist->update([
                'justify' => $time1[$i] ?? '0',
                'injustify' => $time2[$i] ?? '0',
                'total_abs' => $this->total($time1[$i] ?? '0', $time2[$i] ?? '0'),
            ]):
            $this->saveData($id, $time1[$i], $time2[$i]);
            $i++;
        }
    }

    private function saveData($student, $time1, $time2){
        absensTime::create([
            'justify' => $time1 ?? '0',
            'injustify' => $time2 ?? '0',
            'total_abs' => $this->total($time1 ?? '0', $time2 ?? '0'),
            'inscriptif_id' => $student,
            'cutting_school_year_id' => $this->cutting
        ]);
    }

    private function total($nbre1, $nbre2) {
     return ((int)$nbre1 + (int)$nbre2);
    }
}