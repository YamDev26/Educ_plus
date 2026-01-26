<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DaysWeek;

class DaysWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gestion dee Role
        DaysWeek::create(['libelle' => 'lundi', 'order' => 1]);
        DaysWeek::create(['libelle' => 'mardi', 'order' => 2]);
        DaysWeek::create(['libelle' => 'mercredi', 'order' => 3]);
        DaysWeek::create(['libelle' => 'jeudi', 'order' => 4]);
        DaysWeek::create(['libelle' => 'vendredi', 'order' => 5]);
    }
}
