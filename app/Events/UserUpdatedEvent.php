<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpdatedEvent
{
    use Dispatchable, SerializesModels;

    public $name1, $name2, $civilite, $piece, $num_piece, $contact1, $contact2, $email, $niveau, $diplome, $autorise, $num_autorise, $profile, $anciennete,  $matter, $statut, $user;
    public function __construct($name1, $name2, $civilite, $piece, $num_piece, $contact1, $contact2 = null, $email, $niveau, $diplome, $autorise = null, $num_autorise = null, $profile, $anciennete = null, $matter = null, $statut, $user)
    {
        $this->name1 = $name1;
        $this->name2 = $name2;
        $this->civilite = $civilite;
        $this->piece = $piece;
        $this->num_piece = $num_piece;
        $this->contact1 = $contact1;
        $this->contact2 = $contact2;
        $this->email = $email;
        $this->niveau = $niveau;
        $this->diplome = $diplome;
        $this->autorise = $autorise;
        $this->num_autorise = $num_autorise;
        $this->profile = $profile;
        $this->anciennete = $anciennete;
        $this->matter = $matter;
        $this->statut = $statut;
        $this->user = $user;
    }
}
