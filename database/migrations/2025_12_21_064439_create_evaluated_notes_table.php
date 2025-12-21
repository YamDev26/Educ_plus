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
        Schema::create('evaluated_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valeur');
            $table->unsignedBigInteger('evuluated_id');
            $table->unsignedBigInteger('inscriptif_id');
            $table->foreign('evuluated_id')->references('id')->on('evuluateds')->onDelete('cascade');
            $table->foreign('inscriptif_id')->references('id')->on('inscriptifs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluated_notes');
    }
};
