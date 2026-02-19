<?php

namespace App\Services;

use App\Models\School;
use App\Models\Classe;
use App\Models\Approved;
use App\Models\Evuluated;
use App\Models\ClasseUser;
use App\Models\Inscriptif;
use App\Models\MatterMoyenne;
use App\Models\EvaluatedNote;
use App\Models\DisciplineLevel;
use App\Models\SubMatterMoyenne;
use App\Models\CuttingSchoolYear;
use App\Events\EvaluatedNoteEvent;
use App\Jobs\MatterMoyenneJob;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\CalculMoyenneClasseMatter;
use App\Jobs\SubMatterMoyenneJob;
use App\imports\EvaluatedImport;
use PDF;

class EvaluatedService
{
  public function pdf($evaluated, $str){
    $teacher = $this->teacher($evaluated['classe_id'], $evaluated['discipline_level_id']);
    $datas = $this->getNotStudentEndMatter($str);
    $pdf = PDF::loadView('pages.evaluated.pdf.list_not',[
      'evaluated' => $evaluated,
      'students' => $datas,
      'enseignant' => $teacher,
      'school' => School::first()
    ]);
   return $pdf->setPaper('A4', 'portrait'); // ou 'A4', 'A3', etc.
  }


  public function pdf2($str){
    list($class, $matter, $cutting) = explode("_", $str, 3);
    $classe = Classe::find($class);
    $matters = DisciplineLevel::find($matter);
    $cuttings = CuttingSchoolYear::find($cutting);
    $evaluated = $this->evuluated($matter, $cutting, $class);
    $data = $this->getNotStudent($class, $evaluated, $matter, $cutting);
    $pdf = PDF::loadView('pages.evaluated.pdf.list_moyenne',[
      'classe' => $classe,
      'students' => $data,
      'matters' => $matters,
      'cuttings' => $cuttings,
      'evaluated' => $evaluated,
      'school' => School::first(),
      'enseignant' => $this->teacher($class, $matter)
    ]);
    return $pdf->setPaper('A4', 'portrait'); // ou 'A4', 'A3', etc.
  }


  public function import($evaluated, $file){
    Excel::import(new EvaluatedImport($evaluated), $file);
    $evaled = Evuluated::find($evaluated);
    $this->declencheJobNote($evaled); // Déclenchement de Jobs Pour Calcul De Moyenne
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
        'evaluated' => $this->evuluated($matter, $item->id)
      ];
      $i++;
    }
    return $table;
  }


  public function nonApproved($class, $matter, $cutting){
    $dts = Approved::where('classe_id', $class)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first();
    return $dts;
  }


  public function approved($class, $matter, $cutting){
    $exist = $this->nonApproved($class, $matter, $cutting);
    if(!$exist){
      Approved::create([
        'classe_id' => $class,
        'discipline_level_id' => $matter,
        'cutting_school_year_id' => $cutting
      ]);
      CalculMoyenneClasseMatter::dispatch($class, $matter, $cutting);
    }
  }


  public function verify($classe, $matter, $cutting, $type, $value, $created){
    $count = Evuluated::where('classe_id', $classe)
    ->where('value', '=', $value)
    ->where('created', '=', $created)
    ->where('evaluadet_type_id', $type)
    ->where('discipline_level_id', $matter)
    ->where('cutting_school_year_id', $cutting)
    ->count();
    return $count;
  }


  public function createEvaluated($value, $date, $classe, $sub = null, $type, $matter, $cutting){
    $data = Evuluated::create([
      'value' => $value,
      'created' => $date,
      'classe_id'  => $classe,
      'sub_matter_id' => $sub,
      'evaluadet_type_id' => $type,
      'discipline_level_id'=> $matter,
      'cutting_school_year_id' => $cutting
    ]);
    return $data->id;
  }


  public function getStudent($class){
    $data = Inscriptif::join('students', 'students.id', '=', 'inscriptifs.student_id')
    ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
    ->where('inscriptifs.classe_id', '=', $class)
    ->orderBy('students.first_name')
    ->orderBy('students.last_name')
    ->get();
    return $data;
  }


  public function getNotStudentEndMatter($evaluated){
    $data = EvaluatedNote::join('evuluateds', 'evuluateds.id', '=', 'evaluated_notes.evuluated_id')
    ->join('inscriptifs', 'inscriptifs.id', '=', 'evaluated_notes.inscriptif_id')
    ->join('students', 'students.id', '=', 'inscriptifs.student_id')
    ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id', 'evuluateds.value', 'evaluated_notes.valeur')
    ->where('evuluateds.id', '=', $evaluated)
    ->orderBy('students.first_name')
    ->orderBy('students.last_name')
    ->get();
    return $data;
  }


  public function getNotStudent($class, $evaluated, $matter, $cutting, $etat = null){
    $student = $this->getStudent($class);
    $table = [];
    foreach($student as $item){
      $table[] = [
        'id' => $item->id,
        'name' => strtoupper($item->first_name).' '.ucwords($item->last_name),
        'matricule' => $item->matricule,
        'genre' => ucwords($item->genre),
        'notes' => $etat ? $this->subMoyenneGet($item->id, $cutting):$this->getNotStudentMatte($item->id, $evaluated),
        'resultat' => $this->moyenne($item->id, $matter, $cutting)
      ];
    }
    return $table;
  }


  public function evaluat($cutting, $class, $matter, $verify){
    return $verify ? 
    []:
    Evuluated::where('cutting_school_year_id', $cutting)->where('classe_id', $class)->where('discipline_level_id', $matter)->orderBy('created')->get();
  }


  public function saveNote($student, $note, $eval){
    $i = 0;
    while($i < sizeof($student)){
      $count = EvaluatedNote::where('inscriptif_id', $student[$i])->where('evuluated_id', $eval['id'])->count();
      if(!$count){
        $valeur = blank($note[$i]) ? 'nc':$this->valNote($note[$i]);
        event(new EvaluatedNoteEvent($student[$i], $eval['id'], $valeur));
      }
      $i++;
    }
    // Déclenchement de Jobs Pour Calcul De Moyenne
    $this->declencheJobNote($eval);
  }


  public function updateNote($student, $note, $eval){
    $i = 0;
    while($i < sizeof($student)){
      $count = EvaluatedNote::where('inscriptif_id', $student[$i])->where('evuluated_id', $eval['id'])->first();
      if($count){
        $count->update([
          'valeur' => blank($note[$i]) ? 'nc':$this->valNote($note[$i])
        ]);
      }
      $i++;
    }
    // Déclenchement de Jobs Pour Calcul De Moyenne
    $this->declencheJobNote($eval);
  }


  public function getMoyenneStudent($class, $matter, $cutting){
    $student = $this->getStudent($class);
    $table = [];
    foreach($student as $item){
      $table[] = [
        'id' => $item->id,
        'name' => strtoupper($item->first_name).' '.ucwords($item->last_name),
        'matricule' => $item->matricule,
        'genre' => ucwords($item->genre),
        'resultat' => $this->moyenne($item->id, $matter, $cutting)
      ];
    }
    return $table;
  }


  public function destroy($dts){
    $exist = $this->nonApproved($dts['classe_id'], $dts['discipline_level_id'], $dts['cutting_school_year_id']);
    if(!$exist){
      $cutting = CuttingSchoolYear::find($dts['cutting_school_year_id']);
      if($cutting->status != 2){
        $dts->delete();
        $str = 'info';
        $msg = 'Suppression effectuée.';
      }
      else{
        $str = 'warning';
        $msg = 'Action inachevée, '.ucwords($cutting->cutting->libelle).' est terminé !';
      }
    }
    else{
      $str = 'warning';
      $msg = 'Action inachevée, moyenne déjà confirmée !';
    }
    return [$str, $msg];
  }


  // Function Private ----------
  private function valNote($val){
    return match(true){
      strlen((string)$val) == 1 => '0'.$val,
      default => $val
    };
  }

  private function teacher($class, $matter){
    $data = ClasseUser::where('classe_id', $class)->where('discipline_level_id', $matter)->first();
    return $data ? ($data->user->civilite.' '.strtoupper($data->user->first_name).' '.ucwords($data->user->last_name)):null;
  }

  private function declencheJobNote($eval){
    $eval['sub_matter_id'] ?
    SubMatterMoyenneJob::dispatch($eval['classe_id'], $eval['sub_matter_id'], $eval['cutting_school_year_id'], $eval['discipline_level_id']):
    MatterMoyenneJob::dispatch($eval['classe_id'], $eval['discipline_level_id'], $eval['cutting_school_year_id']);
  }

  private function subMoyenneGet($student, $cutting){
    $table = [
      SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 1)->where('cutting_school_year_id', $cutting)->first(),
      SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 2)->where('cutting_school_year_id', $cutting)->first(),
      SubMatterMoyenne::where('inscriptif_id', $student)->where('sub_matter_id', 3)->where('cutting_school_year_id', $cutting)->first()
    ];
    return $table;
  }

  private function getNotStudentMatte($student, $evaluated){
    $note = [];
    foreach($evaluated as $item){
      $note[] = EvaluatedNote::where('inscriptif_id', $student)->where('evuluated_id', $item['id'])->first();
    }
    return $note;
  }

  private function moyenne($item, $matter, $cutting){
    $moyen = MatterMoyenne::where('inscriptif_id', $item)->where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->first();
    return $moyen;
  }

  private function evuluated($matter, $cutting, $class = null){
    return match(true) {
      ($class == null) => Evuluated::where('discipline_level_id', $matter)->where('cutting_school_year_id', $cutting)->orderBy('created')->get(),
      default => Evuluated::where('cutting_school_year_id', $cutting)->where('classe_id', $class)->where('discipline_level_id', $matter)->orderBy('created')->get()
    };
  }

}