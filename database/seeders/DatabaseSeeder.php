<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Serie;
use App\Models\Role;
use App\Models\Cutting;
use App\Models\Level;
use App\Models\Discipline;
use App\Models\BilanMatter;
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

        // Get Bilan Matter Default
        BilanMatter::create(['libelle' => 'bilan lettres']);
        BilanMatter::create(['libelle' => 'bilan sciences']);
        BilanMatter::create(['libelle' => 'bilan autres']);


        // Get Matières  Default
        Discipline::create(['libelle' => 'Anglais', 'abbreviated' => 'Ang', 'ministere' => '1']); // id = 1
        Discipline::create(['libelle' => 'Français', 'abbreviated' => 'Fr', 'ministere' => '1']); // id = 2
        Discipline::create(['libelle' => 'Histoire-Géographie', 'abbreviated' => 'HG', 'ministere' => '1']); // id = 3
        Discipline::create(['libelle' => 'Mathématique', 'abbreviated' => 'Math', 'ministere' => '1']); // id = 4
        Discipline::create(['libelle' => 'Physique-chimie', 'abbreviated' => 'PC', 'ministere' => '1']); // id = 5
        Discipline::create(['libelle' => 'Sciences de la vie et de la terre', 'abbreviated' => 'SVT', 'ministere' => '1']); // id = 6
        Discipline::create(['libelle' => 'Education physique et sportive', 'abbreviated' => 'EPS', 'ministere' => '1']); // id = 7
        Discipline::create(['libelle' => 'Espagnol ', 'abbreviated' => 'Esp', 'ministere' => '1']); // id = 8
        Discipline::create(['libelle' => 'Allemand ', 'abbreviated' => 'All', 'ministere' => '1']); // id = 9
        Discipline::create(['libelle' => 'EDHC', 'abbreviated' => 'EDHC', 'ministere' => '1']); // id = 10
        Discipline::create(['libelle' => 'Musique', 'abbreviated' => 'Mus', 'ministere' => '1']); // id = 11
        Discipline::create(['libelle' => 'Arts plastique', 'abbreviated' => 'AP', 'ministere' => '1']); // id = 12
        Discipline::create(['libelle' => 'Philosophie', 'abbreviated' => 'Philo', 'ministere' => '1']); // id = 13
        Discipline::create(['libelle' => 'Mixte', 'abbreviated' => 'All/Esp']); // id = 14
        Discipline::create(['libelle' => 'Conduite', 'abbreviated' => 'Cdte']); // id = 15

        // User::factory(1)->create();
        User::factory()->create();
    }
}
