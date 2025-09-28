<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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
        


        // User::factory(1)->create();
        User::factory()->create();
    }
}
