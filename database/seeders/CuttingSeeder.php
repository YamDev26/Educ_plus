<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cutting;

class CuttingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Cutting Default
        Cutting::create(['libelle' => 'trimestre 1', 'end' => '0', 'info' => '1']);
        Cutting::create(['libelle' => 'trimestre 2', 'end' => '0', 'info' => '1']);
        Cutting::create(['libelle' => 'trimestre 3', 'end' => '1', 'info' => '1']);
        Cutting::create(['libelle' => 'semestre 1', 'end' => '0', 'info' => '2']);
        Cutting::create(['libelle' => 'semestre 2', 'end' => '1', 'info' => '2']);
    }
}
