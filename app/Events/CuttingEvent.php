<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CuttingEvent
{
    use Dispatchable, SerializesModels;

    public $year;
    public function __construct($year)
    {
        $this->year = $year;
    }
}
