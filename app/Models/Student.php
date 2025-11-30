<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function parent_std(){
        return $this->belongsTo(ParentStd::class);
    }

    public function nationalitie(){
        return $this->belongsTo(Nationality::class);
    }

    public function biological_std(){
        return $this->belongsTo(BiologicalStd::class);
    }
}
