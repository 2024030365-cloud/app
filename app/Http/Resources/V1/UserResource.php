<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nombre' => $this->name,
            'email' => $this->email,
            'empresa' => tenant('id'), 
            'Fecha Creacion' => $this->created_at->format('d-m-Y'),
        ];
    }
}