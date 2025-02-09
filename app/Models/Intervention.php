<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'nature_intervention',
        'duree_intervention',
        'date_debut_intervention',
        'vehicule_id',
        'mecanicien_id',
    ];

    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function mecanicien(): BelongsTo
    {
        return $this->belongsTo(Mecanicien::class);
    }

    public function piecesUtilisees(): HasMany
    {
        return $this->hasMany(PiecesUtilisees::class);
    }

    public function entretienPreventif(): HasOne
    {
        return $this->hasOne(EntretienPreventif::class);
    }
}