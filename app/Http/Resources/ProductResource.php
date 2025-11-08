<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'stock' => $this->getStock(),
            'price' => $this->getPrice(),
            'category' => $this->getCategory(),
            'specs' => $this->getSpecs(),
            'link' => route('products.show', ['id' => $this->getId()]),
        ];
    }
}
