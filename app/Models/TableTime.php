<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableTime extends Model
{
    protected $guarded = [];

    public function discipline_level(){
        return $this->belongsTo(DisciplineLevel::class);
    }
}
