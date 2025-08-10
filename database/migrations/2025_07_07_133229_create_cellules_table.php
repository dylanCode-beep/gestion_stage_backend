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
        Schema::create('cellules', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nom');
            $table->string('description');
            $table->integer('nombre_stagiaire')->nullable();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cellules');
    }
};
