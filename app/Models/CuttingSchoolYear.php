<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuttingSchoolYear extends Model
{
    protected $guarded = [];

    public function cutting(){
        return $this->belongsTo(Cutting::class);
    }
}
