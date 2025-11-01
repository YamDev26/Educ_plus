<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $guarded = [];

    public function classes(){
        return $this->hasMany(Classe::class);
    }

    public function disciplineLevels(){
        return $this->hasMany(DisciplineLevel::class);
    }
}
