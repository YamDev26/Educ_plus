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
        Schema::create('biological_stds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_father')->nullable();
            $table->string('last_father')->nullable();
            $table->string('phon_father')->nullable();
            $table->string('prof_father')->nullable();
            $table->string('first_mother')->nullable();
            $table->string('last_mother')->nullable();
            $table->string('phon_mother')->nullable();
            $table->string('prof_mother')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biological_stds');
    }
};
