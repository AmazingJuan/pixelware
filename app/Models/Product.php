<?php

/*
 * Product.php
 * Model for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Models;


// Laravel / Illuminate classes
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// App
use App\Utils\PresentationUtils;

class Product extends Model
{
    /**
     * Attributes:
     *
     * $this->attributes['id']          - int                        - Primary key identifier
     * $this->attributes['name']        - string                     - Product name
     * $this->attributes['description'] - string                     - Product description
     * $this->attributes['stock']       - int                        - Product stock
     * $this->attributes['price']       - int                        - Product price
     * $this->attributes['category']    - string                     - Product category
     * $this->attributes['specs']       - array                      - Product specifications (JSON)
     * $this->attributes['image_url']  - string                      - Product image URLs (JSON)
     * $this->attributes['average_rating'] - float                  - Average product rating
     * $this->attributes['reviews_count'] - int                     - Number of reviews
     * $this->attributes['times_purchased'] - int                   - Number of times the product has been purchased
     * $this->attributes['created_at']  - \Illuminate\Support\Carbon - Record creation timestamp
     * $this->attributes['updated_at']  - \Illuminate\Support\Carbon - Record last update timestamp
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

    public function getReviews()
    {
        return $this->reviews()->with('user')->get();
    }

    // Setters.

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

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

    // Relationships.

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Util methods.

    public function getFormattedPriceAttribute(): string
    {
        return PresentationUtils::formatCurrency($this->getPrice());
    }

    public function getFormattedSpecsAttribute(): array
    {
        // Format specs for display.
        $formattedSpecs = [];

        foreach ($this->getSpecs() ?? [] as $specName => $specValue) {
            $formattedSpecs[ucfirst($specName)] = $specValue;
        }

        return $formattedSpecs;
    }

    public function decreaseStock(int $quantity): void
    {
        $newStock = $this->getStock() - $quantity;
        // Decrease stock by quantity (assumes validation done elsewhere).
        $this->setStock($newStock);
    }

    public function increaseTimesPurchased(int $quantity): void
    {
        $newTimesPurchased = $this->getTimesPurchased() + $quantity;
        // Increase times purchased by quantity.
        $this->setTimesPurchased($newTimesPurchased);
    }
}
