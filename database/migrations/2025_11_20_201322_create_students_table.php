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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('genre',['F', 'M']);
            $table->date('date_naiss');
            $table->string('lieu_naiss');
            $table->string('num_extrait')->nullable();
            $table->string('residence')->nullable();
            $table->unsignedBigInteger('nationalitie_id');
            $table->string('first_father')->nullable();
            $table->string('last_father')->nullable();
            $table->string('phon_father')->nullable();
            $table->string('prof_father')->nullable();
            $table->string('first_mother')->nullable();
            $table->string('last_mother')->nullable();
            $table->string('phon_mother')->nullable();
            $table->string('prof_mother')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('school_year_id');
            $table->timestamps();
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
