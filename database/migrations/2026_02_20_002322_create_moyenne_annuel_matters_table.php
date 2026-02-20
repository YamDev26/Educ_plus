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
        Schema::create('moyenne_annuel_matters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rang');
            $table->string('moyenne');
            $table->unsignedBigInteger('inscriptif_id');
            $table->unsignedBigInteger('school_year_id');
            $table->unsignedBigInteger('discipline_level_id');
            $table->foreign('inscriptif_id')->references('id')->on('inscriptifs')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('discipline_level_id')->references('id')->on('discipline_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moyenne_annuel_matters');
    }
};
