<?php

namespace Database\Seeders;

use App\Models\EvaluadetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluadetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EvaluadetType::create(['libelle' => 'devoir de classe']);
        EvaluadetType::create(['libelle' => 'devoir de niveau']);
        EvaluadetType::create(['libelle' => 'interrogation ecrite']);
        EvaluadetType::create(['libelle' => 'interrogation orale']);
        EvaluadetType::create(['libelle' => 'activité pratique']);
    }
}
