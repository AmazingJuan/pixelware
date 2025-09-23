<?php

/*
 * ProductRepository.php
 * Repository for managing products db access in the application.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected string $model = Product::class;

    protected array $with = ['reviews'];

    public function getProductsByIds(array $ids)
    {
        // Get products by an array of IDs.
        return $this->query()->whereIn('id', $ids)->get();
    }


    // Get top 3 products by average review rating.
    public function topThree()
    {
        // Get the top 3 products based on average review ratings.
        return $this->query()
            ->orderByDesc('average_rating')
            ->take(3)
            ->get();
    }
}
