<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'numserie' => $this->numserie,
            'user_id' => $this->user_id,
            'marque' => $this->marque,
            'type' => $this->type,
            'annee' => $this->annee,
            'description' => $this->description,
            'statut' => $this->statut,
            'dedouaner' => $this->dedouaner,
            'prixDedouanement' => $this->prixDedouanement,
            'ht' => $this->ht,
            'tva' => $this->tva,
            'ttc' => $this->ttc,
            'created_at' => $this->created_at,
            'photos' => $this->photos,
            'operations' => $this->operations,
        ];
    }
}
