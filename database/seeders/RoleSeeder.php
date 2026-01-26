<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gestion dee Role
        Role::create(['libelle' => 'admin1']);
        Role::create(['libelle' => 'admin']);
        Role::create(['libelle' => 'fondateur']);
        Role::create(['libelle' => 'directeur']);
        Role::create(['libelle' => 'educateur']);
        Role::create(['libelle' => 'enseignant']);
        Role::create(['libelle' => 'comptable']);
        Role::create(['libelle' => 'secretaire']);
    }
}
