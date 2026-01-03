<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $guarded = [];

    public function schoolYear(){
        return $this->belongsTo(SchoolYear::class);
    }
}
