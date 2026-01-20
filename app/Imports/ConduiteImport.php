<?php

namespace App\Imports;

use App\Models\MatterMoyenne;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConduiteImport implements ToCollection, WithHeadingRow
{
    protected $matter, $cutting;
    public function __construct($matter, $cutting)
    {
        $this->matter = $matter;
        $this->cutting = $cutting;
    }


    public function collection(Collection $data)
    {
        
        foreach($data as $item){
            list($student, $cutting, $row) = explode('_', $item['num']);
            $exist = MatterMoyenne::where('inscriptif_id', $student)->where('discipline_level_id', $this->matter)->where('cutting_school_year_id', $cutting)->first();
            if($exist){
                $exist->update([

                ]);
            }
        }
    }


    private function calMoyenne($dts){
        $table = [];
        foreach($dts as $item){
            list($id, $cutting, $row) = explode('_', $item['num'], 3);
            $table[] = [
                'id' => $id,
                'genre' => $item['genre'] == 'Feminin' ? 'F':'M',
                'moyen' => null
            ];
        }
    }
}
