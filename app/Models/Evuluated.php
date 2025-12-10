<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evuluated extends Model
{
    protected $guarded = [];


    public function classe(){
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }

    public function disciplineLevel(){
        return $this->belongsTo(DisciplineLevel::class);
    }
}
