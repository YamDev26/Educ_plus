<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, CanResetPasswordTrait;

    
    const ROLE_ADMIN1 = 'admin1';
    const ROLE_ADMIN = 'admin';
    const ROLE_FONDATEUR = 'fondateur';
    const ROLE_DIRECTEUR = 'directeur';
    const ROLE_EDUCATEUR = 'educateur';
    const ROLE_ENSEIGNANT = 'enseignant';
    const ROLE_SECRETAIRE = 'secretaire';
    const ROLE_COMPTABLE = 'comptable';

    protected $guarded = [];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isAdmin1(){
        return $this->role->libelle === self::ROLE_ADMIN1;
    }

    public function isAdmin(){
        return $this->role->libelle === self::ROLE_ADMIN;
    }

    public function isEnseignant(){
        return $this->role->libelle === self::ROLE_ENSEIGNANT;
    }

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
