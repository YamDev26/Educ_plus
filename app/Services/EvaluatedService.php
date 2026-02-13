<?php

namespace App\Services;


use App\Models\User;
use App\Models\Classe;
use App\Models\Evuluated;
use App\Models\CuttingSchoolYear;

class EvaluatedService
{
  public function classe($str)
  {
    $dts = Classe::find($str);
    return $dts;
  }


  public function getEvaluated($class, $matter){
    $data = CuttingSchoolYear::where('school_year_id', $class['school_year_id'])->get();
    $vals = ['successhome', 'successprofile', 'successcontact'];
    $table = []; $i = 0;
    foreach($data as $item){
      $table[] = [
        'id' => $item->id,
        'idTable' => $vals[$i],
        'status' => $item->status,
        'libelle' => $item->cutting->libelle,
        'evaluated' => Evuluated::where('discipline_level_id', $matter)->where('cutting_school_year_id', $item->id)->orderBy('created')->get()
      ];
      $i++;
    }
    return $table;
    }

}