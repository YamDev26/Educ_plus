<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolYear;
use Carbon\Carbon;

class YearSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default School year .....
        SchoolYear::create([
            'libelle' => '2025-2026',
            'current' => (string)Carbon::now()->year,
            'cutting' => '1',
            'actif' => '1'
        ]);
    }
}
