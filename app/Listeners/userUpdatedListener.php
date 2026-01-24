<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserUpdatedEvent;

class userUpdatedListener
{
    public function handle(UserUpdatedEvent $event): void
    {
        User::where('id', $event->user)->update([
            'first_name' => $event->name1,
            'last_name' => $event->name2,
            'civilite' => $event->civilite,
            'piece' => $event->piece,
            'num_piece' => $event->num_piece,
            'email' => $event->email,
            'contact1' => $event->contact1,
            'contact2' => $event->contact2,
            'niveau' => $event->niveau,
            'diplome' => $event->diplome,
            'autorise' => $event->autorise,
            'num_autorise' => $event->num_autorise,
            'profile' => $event->profile,
            'anciennete' => $event->anciennete,
            'matter' => $event->matter,
            'actif' => $event->statut,
        ]);
    }
}
