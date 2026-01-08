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
        Schema::create('sub_matter_moyennes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rang');
            $table->string('moyenne');
            $table->enum('value',[1,2]);
            $table->unsignedBigInteger('inscriptif_id');
            $table->unsignedBigInteger('sub_matter_id');
            $table->unsignedBigInteger('cutting_school_year_id');
            $table->foreign('inscriptif_id')->references('id')->on('inscriptifs')->onDelete('cascade');
            $table->foreign('sub_matter_id')->references('id')->on('sub_matters')->onDelete('cascade');
            $table->foreign('cutting_school_year_id')->references('id')->on('cutting_school_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_matter_moyennes');
    }
};
