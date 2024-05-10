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
        Schema::create('materials', function (Blueprint $table) {
            $table->id('codeONEE');
            $table->string('sousFamille',255);
            $table->string('designation')->nullable();
            $table->string('activite',255)->nullable();
            $table->string('marque')->nullable();
            $table->string('modelle')->nullable();
            $table->string('numSerie')->nullable();
            $table->string('NomAdresseSite')->nullable();
            $table->string('contratAcquisition')->nullable();
            $table->string('objectif')->nullable();
            $table->string('annee')->nullable();
            $table->string('titulaireMarche')->nullable();
            $table->enum('statut',['actif', 'hors service'])->default('actif');
            $table->string('matricule');
            $table->foreign('matricule')->references('matricule')->on('agents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
