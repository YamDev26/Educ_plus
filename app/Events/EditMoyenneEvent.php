<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EditMoyenneEvent
{
    use Dispatchable, SerializesModels;

    public $student, $moyen, $matter, $cutting;
    public function __construct($student, $moyen, $matter, $cutting)
    {
        $this->student = $student;
        $this->moyen = $moyen;
        $this->matter = $matter;
        $this->cutting = $cutting;
    }
}
