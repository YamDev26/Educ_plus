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
        Schema::create('classe_statistiks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('moyenne');
            $table->integer('nbre_moyenne');
            $table->integer('nbre_non_moyenne');
            $table->string('taux_echec');
            $table->string('taux_reussite');
            $table->integer('nbre_moyenne_feminin');
            $table->integer('nbre_non_moyenne_feminin');
            $table->string('taux_echec_feminin');
            $table->string('taux_reussite_feminin');
            $table->string('taux_feminin');
            $table->integer('nbre_moyenne_masculin');
            $table->integer('nbre_non_moyenne_masculin');
            $table->string('taux_echec_masculin');
            $table->string('taux_reussite_masculin');
            $table->string('taux_masculin');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('cutting_school_year_id');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('cutting_school_year_id')->references('id')->on('cutting_school_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_statistiks');
    }
};
