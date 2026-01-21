<?php

namespace App\Imports;

use App\Jobs\GestionCndteJob;
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
        $student = []; $moyen = []; $justifs = []; $injust = [];
        foreach($data as $item){
            list($id, $i, $row) = explode('_', $item['num']); $sexe = $item['genre'] == 'Feminin' ? 'F':'M';
            $student[] = $id.'_'.$sexe;
            $moyen[] = $item['moyenne'];
            $justifs[] = $item['justifiee'];
            $injust[] = $item['non_justifiee'];
        }
        // Déclenchement de job pour le calcul de moyenne   
        GestionCndteJob::dispatch($student, $moyen, $justifs, $injust, $this->matter, $this->cutting)->delay(now()->addSeconds(2));
    }
}
