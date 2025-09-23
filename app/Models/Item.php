<?php

/*
 * Item.php
 * Model for managing items in the application.
 * Author: Juan Jose Gomez
*/

namespace App\Models;

// Laravel / Illuminate classes
use App\Utils\PresentationUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Application / App
use Illuminate\Support\Carbon;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id']  - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['unit_price'] - int - contains the item price
     * $this->attributes['order_id'] - int - contains the associated order id
     * $this->attributes['product_id'] - int - contains the associated product id
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - contains the item creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - contains the item update timestamp
     */
    protected $fillable = ['quantity', 'unit_price', 'order_id', 'product_id'];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getUnitPrice(): int
    {
        return $this->attributes['unit_price'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    // Setters

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setUnitPrice(int $price): void
    {
        $this->attributes['unit_price'] = $price;
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Methods

    public function getFormattedUnitPrice(): string
    {
        return PresentationUtils::formatCurrency($this->getUnitPrice());
    }

    public function getFormattedSubtotal(): string
    {
        return PresentationUtils::formatCurrency($this->getUnitPrice() * $this->getQuantity());
    }
}
