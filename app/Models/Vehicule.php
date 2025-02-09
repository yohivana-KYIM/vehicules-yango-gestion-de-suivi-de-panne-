<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'model',
        'nom_proprietaire',
    ];

    public function pannes(): HasMany
    {
        return $this->hasMany(Pannes::class);
    }

    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class);
    }
}