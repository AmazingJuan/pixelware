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
        $this->user_id = $user->getId();
    }

    // Utilities
    public function getFormattedTotal(): string
    {
        return PresentationUtils::formatCurrency($this->getTotalPrice());
    }
}
