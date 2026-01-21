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
        Schema::create('absens_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('justify')->nullable();
            $table->string('injustify')->nullable();
            $table->string('total_abs')->nullable();
            $table->unsignedBigInteger('inscriptif_id');
            $table->unsignedBigInteger('cutting_school_year_id');
            $table->foreign('inscriptif_id')->references('id')->on('inscriptifs')->onDelete('cascade');
            $table->foreign('cutting_school_year_id')->references('id')->on('cutting_school_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens_times');
    }
};
