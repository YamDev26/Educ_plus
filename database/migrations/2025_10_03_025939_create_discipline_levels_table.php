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
        Schema::create('discipline_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('coefficient',[1,2,3,4,5]);
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('discipline_id')->nullable();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_levels');
    }
};
