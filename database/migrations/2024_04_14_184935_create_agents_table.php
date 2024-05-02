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
        Schema::create('agents', function (Blueprint $table) {
            $table->string('matricule')->primary();
            $table->string('nomAgent');
            $table->string('prenomAgent');
            $table->string('emploiAgent');
            $table->string('emailAgent')->unique();
            $table->string('mot_de_passeAgent');
            $table->enum('est_admin', ['true', 'false'])->default('false');
            $table->enum('est_suspender', ['true', 'false'])->default('false');
            $table->foreignId('refEntite')->references('refEntite')->on('entites');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
