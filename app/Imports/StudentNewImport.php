<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\ParentStd;
use App\Models\Nationality;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use DateTime;

class StudentNewImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $yearActif;
    public function __construct($yearActif)
    {
        $this->yearActif = $yearActif;
    }
    

    public function collection(Collection $data)
    {
        foreach($data as $item){
            $date = $this->dateFormat($item['date_naissance']);
            if($date){
                $parent = $this->getParent($item['nom_parent'], $item['prenom_parent'], $this->getPhon($item['contact_parent_1']), $item['contact_parent_2'] ? $this->getPhon($item['contact_parent_2']):null);
                Student::create([
                    'matricule' => $item['matricule'],
                    'first_name' => strtolower($item['nom']),
                    'last_name' => strtolower($item['prenoms']),
                    'genre' => $this->getGenre($item['genre']),
                    'date_naiss' => $date,
                    'lieu_naiss' => strtolower($item['lieu_naissance']),
                    'parent_std_id' => $parent,
                    'nationalitie_id' => $this->nationalite($item['nationalite']),
                    'school_year_id' => $this->yearActif,
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.matricule' => 'required|string|min:9|unique:students,matricule',
            '*.nom' => 'required|string',
            '*.prenoms' => 'required|string',
            '*.genre' => 'required|string',
            '*.date_naissance' => 'required|integer',
            '*.lieu_naissance' => 'required|string',
            '*.nationalite' => 'required|string',
            '*.nom_parent' => 'required|string',
            '*.prenom_parent' => 'required|string',
            '*.contact_parent_1' => 'required|numeric',
            '*.contact_parent_2' => 'nullable|numeric',
        ];
    }


    private function getParent($first, $last, $phon1, $phon2 = null){
        $dts = ParentStd::where('phon1', $phon1)->orWhere('phon2', $phon1)->first();
        if(!$dts){
            $query = $phon2 ? ParentStd::where('phon1', $phon2)->orWhere('phon2', $phon2)->first():null;
            $dts = $query ?? ParentStd::create([
                'first' => strtolower($first),
                'last' => strtolower($last),
                'phon1' => $phon1,
                'phon2' => $phon2
            ]);
        }
        return $dts ? $dts->id:null;
    }


    private function nationalite($libelle){
        $dts = Nationality::where('libelle', 'like', "%{$libelle}%")->first();
        if(!$dts){
            $dts = Nationality::create([
                'libelle' => strtolower($libelle)
            ]);
        }
        return $dts ? $dts->id:null;
    }


    private function getGenre($valuer){
        $str = strtolower($valuer);
        return match(true) {
            ($str == 'feminin') => 'F',
            ($str == 'fille') => 'F',
            ($str == 'f') => 'F',
            default => 'M'
        };
    }


    private function getPhon($num){
        $count = strlen((string) abs($num));
        return $count == 10 ? $num:'0'.$num;
    }

    private function dateFormat($value, $format = 'Y-m-d')
    {
        if (is_numeric($value)) {
            try {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($value));
            } catch (\Exception $e) {
                return null;
            }
        } else {
            try {
                return Carbon::createFromFormat($format, $value);
            } catch (\Exception $e) {
                $value = DateTime::createFromFormat('Y-m-d', $value);
                return $value;
            }
        }
    }
}
