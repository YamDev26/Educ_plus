<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEvent
{
    use Dispatchable, SerializesModels;

    public $name1, $name2, $civilite, $piece, $num_piece, $contact1, $contact2, $email, $niveau, $diplome, $autorise, $num_autorise, $profile, $anciennete, $role, $matter;
    public function __construct($name1, $name2, $civilite, $piece, $num_piece, $contact1, $contact2 = null, $email, $niveau, $diplome, $autorise = null, $num_autorise = null, $profile, $anciennete = null, $role, $matter = null)
    {
        $this->name1 = strtolower($name1);
        $this->name2 = strtolower($name2);
        $this->civilite = $civilite;
        $this->piece = $piece;
        $this->num_piece = $num_piece;
        $this->contact1 = $contact1;
        $this->contact2 = $contact2;
        $this->email = strtolower($email);
        $this->niveau = $niveau;
        $this->diplome = strtolower($diplome);
        $this->autorise = $autorise;
        $this->num_autorise = $num_autorise;
        $this->profile = $profile;
        $this->anciennete = $anciennete;
        $this->role = $role;
        $this->matter = $matter;
    }
}