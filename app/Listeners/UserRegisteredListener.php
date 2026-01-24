<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\Hash;

class UserRegisteredListener
{

    public function handle(UserRegisteredEvent $event): void
    {
        User::create([
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
            'role_id' => $event->role,
            'matter' => $event->matter,
            'password' => Hash::make('000000') // 6 fois zéro
        ]);
    }

}
