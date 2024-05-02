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
            $table->enum('sousFamille',['Ordinateur & serveur','Impression & Numérisation']);
            $table->string('designation');
            $table->string('marque');
            $table->string('modelle');
            $table->string('numSerie');
            $table->string('contratAcquisition');
            $table->string('objectif');
            $table->year('annee');
            $table->string('titulaireMarche');
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
