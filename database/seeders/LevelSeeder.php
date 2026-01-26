<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Serie;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Level Default
        Level::create(['libelle' => 'sixième', 'code' => '6eme', 'college' => '1']);
        Level::create(['libelle' => 'cinquième', 'code' => '5eme', 'college' => '1']);
        Level::create(['libelle' => 'quatrième', 'code' => '4eme', 'college' => '1']);
        Level::create(['libelle' => 'troisième', 'code' => '3eme', 'college' => '1']);
        Level::create(['libelle' => 'séconde', 'code' => '2nde', 'lycee' => '1']);
        Level::create(['libelle' => 'première', 'code' => '1ere', 'lycee' => '1']);
        Level::create(['libelle' => 'terminale', 'code' => 'Tle', 'lycee' => '1']);

        // Get Serie Default
        Serie::create(['libelle' => 'A', '2nde' => '1']);
        Serie::create(['libelle' => 'A1', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'A2', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'C', '2nde' => '1', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'D', '1ere' => '1', 'tle' => '1']);
    }
}
