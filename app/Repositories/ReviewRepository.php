<?php

/*
 * ReviewRepository.php
 * Repository for managing reviews db access in the application.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

// App
use App\Models\Review;

class ReviewRepository extends BaseRepository
{
    protected string $model = Review::class;

    protected array $with = ['user', 'product'];
}
