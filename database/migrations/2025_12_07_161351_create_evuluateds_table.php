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
        Schema::create('evuluateds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->string('created');
            $table->enum('actif', [0,1])->default(1);
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('sub_matter_id')->nullable();
            $table->unsignedBigInteger('evaluadet_type_id');
            $table->unsignedBigInteger('discipline_level_id');
            $table->unsignedBigInteger('cutting_school_year_id');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('sub_matter_id')->references('id')->on('sub_matters')->onDelete('cascade');
            $table->foreign('evaluadet_type_id')->references('id')->on('evaluadet_types')->onDelete('cascade');
            $table->foreign('discipline_level_id')->references('id')->on('discipline_levels')->onDelete('cascade');
            $table->foreign('cutting_school_year_id')->references('id')->on('cutting_school_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evuluateds');
    }
};
