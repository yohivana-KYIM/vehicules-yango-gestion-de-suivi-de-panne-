<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pannes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nature',
        'details',
        'date_de_signalement',
        'vehicule_id',
        'chauffeur_id',
    ];
    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function chauffeur(): BelongsTo
    {
        return $this->belongsTo(Chauffeur::class);
    }
}