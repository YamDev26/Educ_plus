<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscriptif extends Model
{
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }
}
