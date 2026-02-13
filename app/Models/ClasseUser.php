<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasseUser extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function discipline_level(){
        return $this->belongsTo(DisciplineLevel::class);
    }
}
