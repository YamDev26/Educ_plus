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
        Schema::create('classe_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('pp',[0,1])->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('discipline_level_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('discipline_level_id')->references('id')->on('discipline_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_users');
    }
};
