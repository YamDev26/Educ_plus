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
        Schema::create('slot_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('debut');
            $table->string('fin');
            $table->integer('order');
            $table->enum('statut',[1,2]); // 1 pour Matin et 2 pour l'après midi ......
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_times');
    }
};
