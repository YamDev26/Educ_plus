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
            $table->string('image')->nullable();
            $table->enum('status',[0, 1])->default(1);
            $table->unsignedBigInteger('parent_std_id');
            $table->unsignedBigInteger('school_year_id');
            $table->unsignedBigInteger('nationalitie_id');
            $table->unsignedBigInteger('biological_std_id')->nullable();
            $table->timestamps();
            $table->foreign('parent_std_id')->references('id')->on('parent_stds')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('biological_std_id')->references('id')->on('biological_stds')->onDelete('cascade');
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
