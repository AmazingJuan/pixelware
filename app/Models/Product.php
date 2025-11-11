<?php

/*
 * Product.php
 * Model for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Models;

// Laravel / Illuminate classes
use App\Utils\PresentationUtils;
use App\Utils\ProductImageUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * Attributes:
     *
     * $this->attributes['id']             - int                        - Primary key identifier
     * $this->attributes['name']           - string                     - Product name
     * $this->attributes['description']    - string                     - Product description
     * $this->attributes['stock']          - int                        - Product stock quantity
     * $this->attributes['price']          - int                        - Product price
     * $this->attributes['category']       - string                     - Product category
     * $this->attributes['specs']          - array|null                 - Product specifications (stored as JSON)
     * $this->attributes['image_url']      - string                     - URL or path of product image
     * $this->attributes['average_rating'] - float                      - Average product rating
     * $this->attributes['reviews_count']  - int                        - Number of reviews
     * $this->attributes['times_purchased']- int                        - Number of times product has been purchased
     * $this->attributes['storage_driver'] - string                     - Storage driver used for images ('local' or 'gcp')
     * $this->attributes['created_at']     - \Illuminate\Support\Carbon - Record creation timestamp
     * $this->attributes['updated_at']     - \Illuminate\Support\Carbon - Record last update timestamp
     * $this->reviews                      - Review[]                   - Collection of reviews associated with this product
     * $this->items                        - Item[]                     - Collection of items associated with this product
     */
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'category',
        'specs',
        'image_url',
        'average_rating',
        'reviews_count',
        'storage_driver',
    ];

    // Getters.

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function getSpecs(): array
    {
        return json_decode($this->attributes['specs'], true) ?? [];
    }

    public function getImageUrl(): string
    {
        return $this->attributes['image_url'];
    }

    public function getAverageRating(): float
    {
        return $this->attributes['average_rating'];
    }

    public function getReviewsCount(): int
    {
        return $this->attributes['reviews_count'];
    }

    public function getTimesPurchased(): int
    {
        return $this->attributes['times_purchased'];
    }

    public function getStorageDriver(): string
    {
        return $this->attributes['storage_driver'];
    }

    // Setters.

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function setSpecs(array $specs): void
    {

        $this->attributes['specs'] = json_encode($specs);
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->attributes['image_url'] = $imageUrl;
    }

    public function setAverageRating(float $averageRating): void
    {
        $this->attributes['average_rating'] = $averageRating;
    }

    public function setReviewsCount(int $reviewsCount): void
    {
        $this->attributes['reviews_count'] = $reviewsCount;
    }

    public function setTimesPurchased(int $timesPurchased): void
    {
        $this->attributes['times_purchased'] = $timesPurchased;
    }

    public function setStorageDriver(string $storageDriver): void
    {
        $this->attributes['storage_driver'] = $storageDriver;
    }

    // Relationships.

    // Reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews()->with('user')->get();
    }

    public function setReviews(Collection $reviews): void
    {
        $this->reviews = $reviews;
    }

    // Items
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items()->get();
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    // Util methods.

    public function getFormattedPriceAttribute(): string
    {
        return PresentationUtils::formatCurrency($this->getPrice());
    }

    public function getFormattedSpecsAttribute(): array
    {
        $formattedSpecs = [];

        foreach ($this->getSpecs() ?? [] as $specName => $specValue) {
            $formattedSpecs[ucfirst($specName)] = $specValue;
        }

        return $formattedSpecs;
    }

    public function decreaseStock(int $quantity): void
    {
        $newStock = $this->getStock() - $quantity;

        $this->setStock($newStock);
    }

    public function increaseTimesPurchased(int $quantity): void
    {
        $newTimesPurchased = $this->getTimesPurchased() + $quantity;

        $this->setTimesPurchased($newTimesPurchased);
    }

    public function publicUrl(): string
    {
        return ProductImageUtils::publicUrl($this->getImageUrl());
    }

    public function scopeTopThreeRating(Builder $query): Builder
    {
        return $query->orderByDesc('average_rating')->take(3);
    }

    public function scopeTopThreeSales(Builder $query): Builder
    {
        return $query->orderByDesc('times_purchased')->take(3);
    }
}
