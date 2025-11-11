<?php

namespace App\Models;

use App\Utils\PresentationUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id']  - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['unit_price'] - int - contains the item price
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - contains the item creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - contains the item update timestamp
     * $this->order - Order - contains the associated Order
     * $this->product - Product - contains the associated Product
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

    public function updateUpdatedAt(Carbon $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function updateCreatedAt(Carbon $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    // Relationships
    // Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    // Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    // Custom Methods
    public function getFormattedUnitPrice(): string
    {
        return PresentationUtils::formatCurrency($this->getUnitPrice());
    }

    public function getFormattedSubtotal(): string
    {
        return PresentationUtils::formatCurrency($this->getUnitPrice() * $this->getQuantity());
    }
}
