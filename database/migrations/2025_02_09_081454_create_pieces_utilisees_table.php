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
        Schema::create('pieces_utilisees', function (Blueprint $table) {
            $table->id();
            $table->string('fournisseur');
            $table->dateTime('date_de_montage');
            $table->dateTime('date_de_changement');
            $table->foreignId('intervention_id')->constrained(); // Foreign key to interventions table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces_utilisees');
    }
};