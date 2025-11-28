<?php

namespace App\Listeners;

use App\Models\Classe;
use App\Models\Inscriptif;
use App\Events\InscriptionEvent;

class InscriptionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InscriptionEvent $event): void
    {
        $val = Inscriptif::create([
            'affected' => $event->affected,
            'repeating' => $event->double,
            'bourse' => $event->bourse,
            'interne' => $event->interne,
            'level_old' => $event->oldLevel,
            'school_old' => $event->oldSchool,
            'classe_id' => $event->classe,
            'lv2' => $event->lv2,
            'student_id' => $event->student,
            'school_year_id' => $event['year']
        ]);
        $val ? $this->updateClass($event->classe):null;
    }


    /** @var Update Classe Inscrite $id */ 
    private function updateClass($id){
        $class = Classe::find($id);
        $class->update(['inscrit' => ((int)$class['inscrit']+1)]);
    }
}
