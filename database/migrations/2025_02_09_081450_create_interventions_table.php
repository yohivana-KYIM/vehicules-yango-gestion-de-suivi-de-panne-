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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('nature_intervention');
            $table->integer('duree_intervention');
            $table->dateTime('date_debut_intervention');
            $table->foreignId('vehicule_id')->constrained(); // Foreign key to vehicules table
            $table->foreignId('mecanicien_id')->constrained(); // Foreign key to mecaniciens table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};