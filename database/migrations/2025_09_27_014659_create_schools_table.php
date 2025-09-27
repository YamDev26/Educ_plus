<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('abrege')->nullable();
            $table->enum('statut', ['prive', 'public']);
            $table->enum('college', [0, 1])->default(1);
            $table->enum('lycee', [0, 1])->default(1);
            $table->string('dren');
            $table->string('ville');
            $table->string('postale')->nullable();
            $table->string('email');
            $table->string('numero');
            $table->string('create'); // date de creation
            $table->string('ouverture')->nullable(); // date d'ouverture
            $table->string('classe')->default(0); // Nombre de classe
            $table->enum('bibliotheque', [0, 1])->default(0);
            $table->enum('phis_chim', [0, 1])->default(0);
            $table->enum('svt', [0, 1])->default(0);
            $table->enum('informatique', [0, 1])->default(0);
            $table->enum('infirmerie', [0, 1])->default(0);
            $table->enum('cantine', [0, 1])->default(0);
            $table->enum('bus', [0, 1])->default(0);
            $table->enum('caisse', [0, 1])->default(0);
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
