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
}
