<?php

/*
 * ItemRepository.php
 * Repository for managing item db access in the application.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

// App
use App\Models\Item;

class ItemRepository extends BaseRepository
{
    protected string $model = Item::class;

    protected array $with = ['order', 'product'];

    public function getItemsByOrderId(int $orderId)
    {
        // Get items by order ID.
        return $this->query()->where('order_id', $orderId)->get();
    }
}
