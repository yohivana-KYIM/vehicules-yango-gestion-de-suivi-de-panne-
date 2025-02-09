<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntretienPreventif extends Model
{
    use HasFactory;

    protected $fillable = [
        'intervention_id',
        'date_planifiee',
        'description',
        'status',
        'cout_estime',
    ];

    public function intervention(): BelongsTo
    {
        return $this->belongsTo(Intervention::class);
    }
}