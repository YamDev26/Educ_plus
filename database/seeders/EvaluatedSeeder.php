<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EvaluadetType;

class EvaluatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Type D'valuation .....
        EvaluadetType::create(['libelle' => 'devoir de classe']);
        EvaluadetType::create(['libelle' => 'devoir de niveau']);
        EvaluadetType::create(['libelle' => 'interrogation ecrite']);
        EvaluadetType::create(['libelle' => 'interrogation orale']);
        EvaluadetType::create(['libelle' => 'activité pratique']);
    }
}
