<?php

namespace App\Imports;

use App\Models\EvaluatedNote;
use App\Events\EvaluatedNoteEvent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class EvaluatedImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $evaluated;
    public function __construct($evaluated)
    {
        $this->evaluated = $evaluated;
    }

    public function collection(Collection $data)
    {
        foreach($data as $item){
            $str = explode('_', $item['num']);
            if(($str[1] == $this->evaluated)  && !$this->verifyNot($str[0])){
                event(new EvaluatedNoteEvent($str[0], $str[1], $this->valNote($item['note']))); // Déclenchement d'événement
            }
        }
    }


    public function rules(): array
    {
        return [
            '*.num' => 'required|string',
            '*.matricule' => 'required|string',
            '*.nom_prenoms' => 'required|string',
            '*.genre' => 'required|string',
            '*.note' => 'nullable|numeric',
        ];
    }


    private function verifyNot($inscriptif){
        $count = EvaluatedNote::where('inscriptif_id', $inscriptif)->where('evuluated_id', $this->evaluated)->count();
        return $count;
    }


    private function valNote($val){
        $note = $val ? str_replace(' ', '', $val):null;
        $val = blank($note) ? 'nc':($note <= 9 ? '0'.$note:$note);
        return  $val;
    }
}
