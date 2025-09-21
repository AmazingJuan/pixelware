<?php

/*
 * Item.php
 * Model for managing items in the application.
 * Author: Juan Jose Gomez
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id']  - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['price'] - int - contains the item price
     * $this->attributes['order_id'] - int - contains the associated order id
     * $this->attributes['product_id'] - int - contains the associated product id
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - contains the item creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - contains the item update timestamp
     */
    protected $fillable = ['quantity', 'price', 'order_id', 'product_id'];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
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

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    // Relationships

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
