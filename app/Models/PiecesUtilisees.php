<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PiecesUtilisees extends Model
{
    use HasFactory;
    protected $fillable = [
        'fournisseur',
        'date_de_montage',
        'date_de_changement',
        'intervention_id',
    ];

    public function intervention(): BelongsTo
    {
        return $this->belongsTo(Intervention::class);
    }
}