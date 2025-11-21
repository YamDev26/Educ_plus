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
        Schema::create('inscriptifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('affected', ['oui', 'non']);
            $table->enum('repeating', ['oui', 'non']);
            $table->enum('bourse', ['non', 'demi', 'plein']);
            $table->string('interne')->default('d/p');
            $table->string('level_old');
            $table->string('school_old')->nullable();
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('lv2', ['allemand', 'espagnol'])->nullable();
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptifs');
    }
};
