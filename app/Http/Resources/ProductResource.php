<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'is_available' => $this->is_available,
            'category' => $this->Category->name,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
