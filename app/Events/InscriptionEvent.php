<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InscriptionEvent
{
    use Dispatchable, SerializesModels;

    public $student, $affected, $double, $bourse, $classe, $year, $lv2, $interne, $oldLevel, $oldSchool;
    public function __construct($student, $affected, $double, $bourse, $classe, $year, $lv2 = null, $interne = null, $oldLevel = null, $oldSchool = null)
    {
        $this->student = $student;
        $this->affected = $affected;
        $this->double = $double;
        $this->bourse = $bourse;
        $this->classe = $classe;
        $this->year = $year;
        $this->lv2 = $lv2;
        $this->interne = $interne;
        $this->oldLevel = $oldLevel;
        $this->oldSchool = $oldSchool;
    }
}
