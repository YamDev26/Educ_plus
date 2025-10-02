<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class School extends Model
{
    protected $guarded = [];

    public function logoUrl(){
        return Storage::url($this->logo);
    }
}
