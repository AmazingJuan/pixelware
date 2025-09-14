<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    // User repository methods would go here

    public function find($id): ?Product
    {
        return Product::find($id);
    }

    public function all(): Collection
    {
        return Product::all();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update($id, array $data): ?Product
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }

        return $product;
    }

    public function delete($id): ?Product
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }

        return $product;
    }
}
