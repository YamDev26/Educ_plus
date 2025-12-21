<?php

namespace App\Imports;

use App\Models\Classe;
use App\Models\Student;
use App\Models\Inscriptif;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Failure;

class InscriptionImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $classe;
    public function __construct($classe)
    {
        $this->classe = $classe;
    }


    public function collection(Collection $data)
    {
        $class = $this->getClass();
        foreach($data as $item){
            $student = $this->getIdStudent($item['matricule']);
            if($student){
                if(!($this->verify($student, $class['school_year_id']))){
                    $dts = Inscriptif::create([
                        'student_id' => $student,
                        'classe_id' => $class['id'],
                        'repeating' => $this->getDoublant($item['redoublant']),
                        'affected' => $this->getAffect($item['affecte']),
                        'bourse' => $this->getBourse($item['bousier']),
                        'lv2' => $class['lv2'] ? $this->getLv2($item['lv2'], $class['lv2']):null,
                        'school_year_id' => $class['school_year_id'],
                    ]);
                    $dts ? $this->updateClasse($class):null;
                }
            }
        }
    }


    public function rules(): array
    {
        return [
            '*.matricule' => 'required|string',
            '*.nom' => 'required|string',
            '*.prenoms' => 'required|string',
            '*.genre' => 'required|string',
            '*.affecte' => 'required|string',
            '*.redoublant' => 'required|string',
            '*.bousier' => 'required|string',
            '*.lv2' => 'nullable|string',
        ];
    }


    private function getClass(){
        $class = Classe::find($this->classe);
        return $class;
    }


    private function getIdStudent($matricule){
        $student = Student::where('matricule', $matricule)->first();
        return $student ? $student->id:null;
    }


    private function getBourse($val){
        $str = strtolower($val);
        return match(true) {
            ($str == 'demi' || $str == 'demi-boursier' || $str == '1/2') => 'demi',
            ($str == 'oui') => 'plein',
            default => 'non'
        };
    }


    private function getAffect($val){
        return strtolower($val) == 'non' ? 'non':'oui';
    }


    private function getDoublant($val){
        return strtolower($val) == 'oui' ? 'oui':'non';
    }


    private function getLv2($val, $lv2){
        if($lv2 == 'mixte'){
            $str = strtolower($val);
            $lv2 = str_starts_with('allemand', substr($str, 0, 2)) ? 'allemand':'espagnol';
        }
        return $lv2;
    }


    private function updateClasse($class){
        $class->update([ 'inscrit' => ((int)$class['inscrit']+1) ]);
    }


    private function verify($id, $year){
        $count = Inscriptif::where('student_id', $id)->where('school_year_id', $year)->count();
        return $count;
    }
}
