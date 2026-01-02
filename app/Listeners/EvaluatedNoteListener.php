<?php

namespace App\Listeners;

use App\Models\EvaluatedNote;
use App\Events\EvaluatedNoteEvent;

class EvaluatedNoteListener
{
    public function handle(EvaluatedNoteEvent $event): void
    {
        EvaluatedNote::create([
            'inscriptif_id' => $event->student,
            'evuluated_id' => $event->evaluated,
            'valeur' => $event->valuer
        ]);
    }
}
