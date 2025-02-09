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
        Schema::create('entretien_preventifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervention_id')->constrained(); // Foreign key to interventions table
            $table->date('date_planifiee')->nullable(); // Planned date for the maintenance
            $table->text('description')->nullable(); // Description of the preventive maintenance tasks
            $table->string('status')->default('planifie'); // Status: planifie (planned), en cours (in progress), termine (completed), annule (cancelled)
            $table->decimal('cout_estime', 10, 2)->nullable(); // Estimated cost
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretien_preventifs');
    }
};
