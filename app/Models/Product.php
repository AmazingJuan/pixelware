<?php

/*
 * Product.php
 * Model for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Models;

// Laravel / Illuminate classes
use App\Utils\PresentationUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
        $path = $this->attributes['image_url'] ?? null;

        // 1) Si no hay imagen, devolver una por defecto (pon este archivo en public/images/)
        if (empty($path)) {
            return asset('images/default-product.png');
        }

        // 2) Si ya es una URL completa (por ejemplo: https://storage.googleapis.com/...) devolver tal cual
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // 3) Si el archivo existe en el storage local (disk "public"), usar esa URL
        if (Storage::disk('public')->exists(ltrim($path, '/'))) {
            return asset('storage/' . ltrim($path, '/'));
        }

        // 4) Si no está local, asumir que está en GCP y construir la URL pública del bucket
        $bucket = env('GCP_BUCKET', null);
        if ($bucket) {
            return 'https://storage.googleapis.com/' . $bucket . '/' . ltrim($path, '/');
        }

        // 5) Fallback: devolver la ruta local por defecto
        return asset('storage/' . ltrim($path, '/'));
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

    public function getReviews(): Collection
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

    public function reviews(): HasMany
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

    public function scopeTopThreeRating(Builder $query): Builder
    {
        return $query->orderByDesc('average_rating')->take(3);
    }

    public function scopeTopThreeSales(Builder $query): Builder
    {
        return $query->orderByDesc('times_purchased')->take(3);
    }
}
