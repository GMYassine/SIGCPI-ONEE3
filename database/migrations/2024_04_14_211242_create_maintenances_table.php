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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('refMaintenance');
            $table->date('dateDebutMaintenance');
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
            $table->date('dateFinMaintenance')->nullable();
            $table->enum('etat',['en cours', 'fermée'])->default('en cours');
            $table->text('remarquer')->nullable();
            // new attributes
            $table->enum('est_remplace',['true', 'false'])->nullable();
            $table->string('remplace_avec')->nullable();
            $table->string('refDeclaration')->nullable();
            //
            $table->foreignId('refSM')->references('refSM')->on('societe_maintenances');
            $table->foreignId('codeONEE')->references('codeONEE')->on('materials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
