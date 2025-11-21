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
        Schema::create('parent_stds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first');
            $table->string('last')->nullable();
            $table->string('phon1')->unique();
            $table->string('phon2')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('profession')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_stds');
    }
};
