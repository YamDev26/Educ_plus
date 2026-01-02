<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EvaluatedNoteEvent
{
    use Dispatchable, SerializesModels;

    public $student, $evaluated, $valuer;
    public function __construct($student, $evaluated, $valuer)
    {
        $this->student = $student;
        $this->evaluated = $evaluated;
        $this->valuer = $valuer;
    }
}
