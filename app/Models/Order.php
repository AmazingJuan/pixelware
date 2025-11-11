<?php

namespace App\Models;

use App\Utils\PresentationUtils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id']        - int                 - contains the order primary key (id)
     * $this->attributes['status']    - string              - contains the order status
     * $this->attributes['total']     - int                 - contains the total price of the order in cents
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - contains the order creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - contains the order update timestamp
     * $this->user                     - User                - contains the associated User model
     * $this->items                    - Item[] - contains the associated Items
     */
    protected $fillable = ['user_id', 'status', 'total'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTotalPrice(): int
    {
        return $this->attributes['total'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'] instanceof Carbon
            ? $this->attributes['created_at']
            : Carbon::parse($this->attributes['created_at']);
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'] instanceof Carbon
            ? $this->attributes['updated_at']
            : Carbon::parse($this->attributes['updated_at']);
    }

    // Setters

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    // Relationships
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): HasMany
    {
        return $this->items();
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): BelongsTo
    {
        return $this->user();
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    // Utilities
    public function getFormattedTotal(): string
    {
        return PresentationUtils::formatCurrency($this->getTotalPrice());
    }
}
