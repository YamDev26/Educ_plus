<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubMatter;
use App\Models\Discipline;
use App\Models\BilanMatter;

class MatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Bilan Matter Default
        BilanMatter::create(['libelle' => 'bilan lettres']);
        BilanMatter::create(['libelle' => 'bilan sciences']);
        BilanMatter::create(['libelle' => 'bilan autres']);


        // Get Matières  Default
        Discipline::create(['libelle' => 'Anglais', 'abbreviat' => 'Ang', 'bilan_matter_id' => 1, 'bilan_ordre' => 3]);
        Discipline::create(['libelle' => 'Français', 'abbreviat' => 'Fr', 'bilan_matter_id' => 1, 'bilan_ordre' => 2]);
        Discipline::create(['libelle' => 'Histoire-Géographie', 'abbreviat' => 'HG', 'bilan_matter_id' => 1, 'bilan_ordre' => 5]);
        Discipline::create(['libelle' => 'Mathématique', 'abbreviat' => 'Math', 'bilan_matter_id' => 2, 'bilan_ordre' => 1]);
        Discipline::create(['libelle' => 'Physique-Chimie', 'abbreviat' => 'PC', 'bilan_matter_id' => 2, 'bilan_ordre' => 2]);
        Discipline::create(['libelle' => 'Sciences de la vie et de la terre', 'abbreviat' => 'SVT', 'bilan_matter_id' => 2, 'bilan_ordre' => 3]);
        Discipline::create(['libelle' => 'Education physique et sportive', 'abbreviat' => 'EPS', 'bilan_matter_id' => 3, 'bilan_ordre' => 1]);
        Discipline::create(['libelle' => 'Allemand/Espagnol', 'abbreviat' => 'LV2', 'bilan_matter_id' => 1, 'bilan_ordre' => 4]); // id = 8
        Discipline::create(['libelle' => 'EDHC', 'abbreviat' => 'EDHC', 'bilan_matter_id' => 3, 'bilan_ordre' => 2]);
        Discipline::create(['libelle' => 'Musique/Arts Plastique', 'abbreviat' => 'Mus/AP', 'bilan_matter_id' => 3, 'bilan_ordre' => 3]);
        Discipline::create(['libelle' => 'Philosophie', 'abbreviat' => 'Philo', 'bilan_matter_id' => 1, 'bilan_ordre' => 1]);
        Discipline::create(['libelle' => 'Informatique', 'abbreviat' => 'Tic', 'bilan_matter_id' => 3, 'bilan_ordre' => 4]);
        Discipline::create(['libelle' => 'Conduite', 'abbreviat' => 'Cdte', 'bilan_matter_id' => 3, 'bilan_ordre' => 5]); // id = 13

        // Gestion des sous matieres par defaut
        SubMatter::create(['libelle' => 'Composition Française', 'abbreviated' => 'CF', 'discipline_id' => 2]); // Expression Ecrit
        SubMatter::create(['libelle' => 'Orthographe-Grammaire', 'abbreviated' => 'OG', 'discipline_id' => 2]);
        SubMatter::create(['libelle' => 'Expression Orale', 'abbreviated' => 'E0', 'discipline_id' => 2]);
    }
}
