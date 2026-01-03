<?php

namespace App\Listeners;

use App\Models\MatterMoyenne;
use App\Events\EditMoyenneEvent;

class EditMoyenneListener
{
    /**
     * Handle the event.
     */
    public function handle(EditMoyenneEvent $event): void
    {
        $data = ClassementStudent($this->getMoyenne($event->student, $event->moyen));
        foreach($data as $item){
            if($item){
                MatterMoyenne::where('inscriptif_id', $item['id'])->where('discipline_level_id', $event->matter)->where('cutting_school_year_id', $event->cutting)->update([
                    'rang' => $item['rang'],
                    'moyenne' => $item['moyen']
                ]);
            }
        }
    }


    private function getMoyenne($student, $moyens){
        $table = []; $i = 0;
        while($i < sizeof($student)){
            list($id, $genre) = explode('_', $student[$i], 2);
            $moyen = blank($moyens[$i]) ? 'nc':$this->valMoyenne($moyens[$i]);
            $table[] = [
                'id' => $id,
                'genre' => $genre,
                'moyen' => $moyen
            ];
            $i++;
        }
        return $table;
    }


    private function valMoyenne($val){
        $moyen = $val == 'nc' ? 'nc':number_format($val, 2, '.', ' ');
        return $moyen != 'nc' ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;
    }
}
