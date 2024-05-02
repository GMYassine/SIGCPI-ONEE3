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
        Schema::create('enregistrements', function (Blueprint $table) {
            $table->id('refEnregistrement');
            $table->date('dateEnregistrement');
            $table->string('typeEnregistrement');
            $table->text('description');
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
        Schema::dropIfExists('enregistrements');
    }
};
