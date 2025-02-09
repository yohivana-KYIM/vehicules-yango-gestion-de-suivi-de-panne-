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
        Schema::create('pannes', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->text('details')->nullable();
            $table->dateTime('date_de_signalement');
            $table->foreignId('vehicule_id')->constrained(); // Foreign key to vehicules table
            $table->foreignId('chauffeur_id')->constrained(); // Foreign key to chauffeurs table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pannes');
    }
};