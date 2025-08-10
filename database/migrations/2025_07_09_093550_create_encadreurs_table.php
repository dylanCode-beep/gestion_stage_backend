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
        Schema::create('encadreurs', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('cellule_id')->constrained('cellules')->references('id')->onDelete('cascade');
            $table->string('num_cni');
            $table->integer('telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encadreurs');
    }
};
