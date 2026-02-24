<?php

  namespace App\Services;

  use App\Models\Moyenne;
  use App\Models\Approved;
  use App\Models\SchoolYear;
  use App\Models\ClasseUser;
  use App\Models\Inscriptif;
  use App\Models\Discipline;
  use App\Models\MatterMoyenne;
  use App\Models\SubMatterMoyenne;
  use Illuminate\Support\Facades\DB;

  class MoyenneService
  {

    public function getMoyenneStudent($class, $cutting){
      $data = $this->getStudent($class);
      $student = [];
      foreach($data as $item){
        $student[] = [
          'id' => $item['id'],
          'genre' => $item['genre'],
          'matricule' => $item['matricule'],
          'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
          'moyens' => $this->getMoyenMatter($item['id'], $class, $cutting),
          'moyen' => Moyenne::where('inscriptif_id', $item['id'])->where('cutting_school_year_id', $cutting)->first()
        ];
      }
      return $student;
    }


    public function getMatters($class){
      if(in_array($class['level_id'], [1, 2, 3, 4])){
        return array_merge($this->subMatter(),$this->matters($class, 1), $this->matters($class, 2), $this->matters($class, 3));
      }
      return array_merge($this->matters($class, 1), $this->matters($class, 2), $this->matters($class, 3));
    }


    public function getMoyenneMatterStudent($class, $cutting, $matter){
      $data = $this->getStudent($class);
      $student = [];
      foreach($data as $item){
        $student[] = [
          'id' => $item['id'],
          'genre' => $item['genre'],
          'matricule' => $item['matricule'],
          'name' => strtoupper($item['first_name']). ' '.ucwords($item['last_name']),
          'moyen' => $this->moyenneMatter($item['id'], $cutting, $matter)
        ];
      }
      return $student;
    }


    public function getMatterApproved($class, $cutting){
      $autre = $class['autre'] ? ($class['autre'] == 'musique' ? 'Mus':'AP'):null;
      $data = Approved::join('discipline_levels', 'discipline_levels.id', '=', 'approveds.discipline_level_id')
      ->join('disciplines', 'disciplines.id', '=', 'discipline_levels.discipline_id')
      ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat', DB::raw("IF(abbreviat = 'Mus/AP', '$autre', abbreviat) as abbreviat"))
      ->where('discipline_levels.level_id', $class['level_id'])
      ->where('discipline_levels.serie_id', $class['serie_id'])
      ->where('approveds.cutting_school_year_id', $cutting)
      ->orderBy('disciplines.libelle')->get();
      return $data ? json_decode($data, true):null; 
    }


    public function getCutting($data){
      $table = [];
      foreach($data as $item){
        $table[] = [
          'id' => $item->id,
          'libelle' => ucwords($item->cutting->libelle)
        ];
      }
      return $table;
    }


    public function enseignant($class){
      $data = ClasseUser::where('classe_id', $class)->where('pp', '1')->first();
      return $data ? ($data->user->civilite.' '.strtoupper($data->user->first_name).' '.ucwords($data->user->last_name)):null;
    }


    public function yearActif(){
      $actif = SchoolYear::where('actif', '1')->first();
      return $actif->id;
    }

    // ------------------------
    private function getMoyenMatter($student, $class, $cutting){
      $matters = array_merge($this->matters($class, 1), $this->matters($class, 2), $this->matters($class, 3));
      $data = []; $french = null;
      foreach($matters as $item){
        $data[] = $this->moyenneMatter($student, $cutting, $item['id']);
        $french = $item['abbreviat'] == 'Fr' ? $item['id']:$french;
      }
      if(in_array($class['level_id'], [1, 2, 3, 4])){
        return array_merge($this->moyenSubMatter($student, $cutting, $french), $data);
      }
      return $data;
    }

    private function getStudent($class){
      $data = Inscriptif::join('students', 'students.id', '=', 'inscriptifs.student_id')
      ->select('students.first_name', 'students.last_name', 'students.matricule', 'students.genre', 'inscriptifs.id')
      ->where('inscriptifs.classe_id', '=', $class['id'])
      ->orderBy('students.first_name')
      ->orderBy('students.last_name')
      ->get();
      return json_decode($data, true);
    }

    private function subMatter(){
      $data = DB::table('sub_matters')
      ->select('sub_matters.id', 'sub_matters.libelle', 'sub_matters.abbreviated as abbreviat')
      ->orderBy('sub_matters.id')->get();
      return $data ? json_decode($data, true):null;
    }

    private function matters($class, $bilan){
      $autre = $class['autre'] ? ($class['autre'] == 'musique' ? 'Mus':'AP'):null;
      $data = Discipline::join('discipline_levels', 'disciplines.id', '=', 'discipline_levels.discipline_id')
      ->select('discipline_levels.id', 'disciplines.libelle', 'disciplines.abbreviat', DB::raw("IF(abbreviat = 'Mus/AP', '$autre', abbreviat) as abbreviat"))
      ->where('discipline_levels.level_id', '=', $class['level_id'])
      ->where('discipline_levels.serie_id', '=', $class['serie_id'])
      ->where('disciplines.bilan_matter_id', '=', $bilan)
      ->orderBy('disciplines.bilan_ordre')->get();
      return $data ? json_decode($data, true):null;
    }

    private function moyenneMatter($student, $cutting, $matter) {
      $verify = $this->verifyApproved($cutting, $matter);
      $val = $verify ? 
      MatterMoyenne::where('inscriptif_id', $student)->where('cutting_school_year_id', $cutting)->where('discipline_level_id', $matter)->first():
      null;
      return $val ? $val['moyenne']:'---';
    }

    private function moyenSubMatter($item, $cutting, $matter) {
      $check = $this->verifyApproved($cutting, $matter);
      $table = [];
      $i = 1; 
      while($i < 4) { // id des sous matieres en français
        $val = $check ? 
        SubMatterMoyenne::where('inscriptif_id', $item)->where('sub_matter_id', $i)->where('cutting_school_year_id', $cutting)->first()
        :null;
        $table[] = $val ? $val['moyenne']:'---';
        $i++;
      }
      return $table;
    }

    private function verifyApproved($cutting, $matter) {
      $verify = Approved::where('cutting_school_year_id', $cutting)->where('discipline_level_id', $matter)->first();
      return $verify ? true:false;
    }

  }