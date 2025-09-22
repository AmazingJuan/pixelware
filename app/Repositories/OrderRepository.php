<?php

/*
 * OrderRepository.php
 * Repository for managing order db access in the application.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    protected string $model = Order::class;

    protected array $with = ['user', 'items.product'];

    public function getOrdersByUserId(int $userId)
    {
        // Get orders by user ID.
        return $this->query()->where('user_id', $userId)->get();
    }
}
