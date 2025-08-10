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
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('etablissement');
            $table->string('filiere');
            $table->string('niveau');
            $table->string('sexe')->nullable();
            $table->date('datenaissance')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stagiaires');
    }
};
