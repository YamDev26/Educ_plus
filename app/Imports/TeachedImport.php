<?php

namespace App\Imports;

use App\Events\UserRegisteredEvent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class TeachedImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $data)
    {
        foreach($data as $item){
            event(new UserRegisteredEvent($item['nom'], $item['prenoms'], $this->civilite($item['civilite']), $this->piece($item['piece']), $item['num_piece'],
            $this->compte($item['contact_1']), $this->compte($item['contact_2']), $item['email'], $this->majuscule($item['niveau_etude']), $item['diplome'],
            $this->autorise($item['autorisation']),  $item['num_autorisation'], $this->embauche($item['type_embauche']), $item['annee_enseignement'], 6, $item['matiere_enseignee']));
        }
    }


    public function rules(): array
    {
        return [
            '*.civilite' => 'required|string',
            '*.nom' => 'required|string',
            '*.prenoms' => 'required|string',
            '*.piece' => 'required|string',
            '*.num_piece' => 'required|string',
            '*.email' => 'required|email|unique:users,email',
            '*.contact_1' => 'required|numeric|unique:users,contact1',
            '*.contact_2' => 'nullable|numeric|unique:users,contact2',
            '*.niveau_etude' => 'required|string',
            '*.diplome' => 'required|string',
            '*.autorisation' => 'required|string',
            '*.num_autorisation' => 'nullable|string',
            '*.type_embauche' => 'required|string',
            '*.annee_enseignement' => 'nullable|integer',
            '*.matiere_enseignee' => 'required|string',
        ];
    }

    private function civilite($val){
        return match(true) {
            ($val == 'Mme' || $val == 'Madame') => 'Mme',
            default => 'M'
        };
    }

    private function compte($contact){
        if($contact){
            $val = strlen((string) $contact);
        }
        return $contact ? ($val == 10 ? $contact:'0'.$contact):null;
    }

    private function majuscule($val){
        $valeur = strtoupper($val);
        return trim($valeur);
    }

    private function autorise($val){
        return match(true) {
            (strtolower($val) == 'oui') => 'oui',
            default => 'non'
        };
    }

    private function piece($val){
        $table = ['carte d\'identité', 'parmis de conduire', 'passport'];
        return match(true) {
           (strtolower($val) == $table[1]) => $table[1],
           (strtolower($val) == $table[2]) => $table[2],
           default => $table[0]
        };
    }

    private function embauche($val){
        $table = ['permanant', 'vacataire'];
        return match(true){
            (strtolower($val) == $table[1]) => $table[1],
            default => $table[0]
        };
    }
}
