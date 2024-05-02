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
        Schema::create('declarations', function (Blueprint $table) {
            $table->id('refDeclaration');
            $table->date('dateDeclaration');
            $table->enum('raisonsPrincipales', [
                'Le ventilateur de l`unité centrale ne fonctionne pas correctement',
                'L`ordinateur affiche des erreurs de démarrage',
                'La carte mère semble être endommagée',
                'L`écran présente des pixels morts ou défectueux',
                'Il y a des lignes ou des distorsions sur l`affichage',
                'L`écran ne s`allume pas du tout',
                'autre',
            ]);
            $table->text('description');
            $table->enum('est_ferme', ['true', 'false'])->default('false');
            $table->string('matricule');
            $table->foreign('matricule')->references('matricule')->on('agents');
            $table->foreignId('codeONEE')->references('codeONEE')->on('materials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarations');
    }
};
