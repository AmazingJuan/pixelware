<?php

/*
 * Order.php
 * Model for managing orders in the application.
 * Author: Juan Jose Gomez
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['user_id'] - int - contains the associated user id
     * $this->attributes['status'] - string - contains the order status
     * $this->attributes['total'] - int - contains the total price of the order
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - contains the order creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - contains the order update timestamp
     */
    protected $fillable = ['user_id', 'status', 'total'];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTotalPrice(): int
    {
        return $this->attributes['total_price'];
    }

    public function getCreatedAt(): \Illuminate\Support\Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): \Illuminate\Support\Carbon
    {
        return $this->attributes['updated_at'];
    }

    // Setters

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    // Relationships

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
