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
        Schema::create('table_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('moment',[1,2]);
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('slot_time_id');
            $table->unsignedBigInteger('days_week_id');
            $table->unsignedBigInteger('discipline_level_id');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('slot_time_id')->references('id')->on('slot_times')->onDelete('cascade');
            $table->foreign('days_week_id')->references('id')->on('days_weeks')->onDelete('cascade');
            $table->foreign('discipline_level_id')->references('id')->on('discipline_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_times');
    }
};
