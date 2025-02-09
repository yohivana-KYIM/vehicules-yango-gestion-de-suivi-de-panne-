<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehiculeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marque' => $this->marque,
            'model' => $this->model,
            'nom_proprietaire' => $this->nom_proprietaire,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}