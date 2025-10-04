<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplineLevel extends Model
{
    protected $guarded = [];

    public function discipline(){
        return $this->belongsTo(Discipline::class);
    }
}
