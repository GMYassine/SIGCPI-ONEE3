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
        Schema::create('societe_maintenances', function (Blueprint $table) {
            $table->id('refSM');
            $table->string('nomSM');
            $table->string('emailSM');
            $table->enum('est_actif', ['true', 'false']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societe_maintenances');
    }
};
