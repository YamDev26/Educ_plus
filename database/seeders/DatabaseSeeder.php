<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Serie;
use App\Models\Role;
use App\Models\Cutting;
use App\Models\Level;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gestion dee Role
        Role::create(['libelle' => 'admin1']);
        Role::create(['libelle' => 'admin']);
        Role::create(['libelle' => 'directeur general']);
        Role::create(['libelle' => 'directeur adjoint']);
        Role::create(['libelle' => 'directeur des etudes']);
        Role::create(['libelle' => 'educateur']);
        Role::create(['libelle' => 'enseignant']);
        Role::create(['libelle' => 'comptable']);
        Role::create(['libelle' => 'secretaire']);

        // Get Cutting Default
        Cutting::create(['libelle' => 'trimestre 1', 'end' => '0', 'info' => '1']);
        Cutting::create(['libelle' => 'trimestre 2', 'end' => '0', 'info' => '1']);
        Cutting::create(['libelle' => 'trimestre 3', 'end' => '1', 'info' => '1']);
        Cutting::create(['libelle' => 'semestre 1', 'end' => '0', 'info' => '2']);
        Cutting::create(['libelle' => 'semestre 2', 'end' => '1', 'info' => '2']);
        
        // Get Serie Default
        Serie::create(['libelle' => 'A', '2nde' => '1']);
        Serie::create(['libelle' => 'A1', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'A2', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'C', '2nde' => '1', '1ere' => '1', 'tle' => '1']);
        Serie::create(['libelle' => 'D', '1ere' => '1', 'tle' => '1']);

        // Get Level Default
        Level::create(['libelle' => 'sixième', 'code' => '6eme', 'college' => '1']);
        Level::create(['libelle' => 'cinquième', 'code' => '5eme', 'college' => '1']);
        Level::create(['libelle' => 'quatrième', 'code' => '4eme', 'college' => '1']);
        Level::create(['libelle' => 'troisième', 'code' => '3eme', 'college' => '1']);
        Level::create(['libelle' => 'séconde', 'code' => '2nd', 'lycee' => '1']);
        Level::create(['libelle' => 'première', 'code' => '1ere', 'lycee' => '1']);
        Level::create(['libelle' => 'terminale', 'code' => 'Tle', 'lycee' => '1']);

        // User::factory(1)->create();
        User::factory()->create();
    }
}
