<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Attributes:
     *
     * $this->attributes['id'] - int - Primary key identifier
     * $this->attributes['name'] - string - Product name
     * $this->attributes['description'] - string - Product description
     * $this->attributes['stock'] - int - Product stock
     * $this->attributes['price'] - int - Product price
     * $this->attributes['category'] - string - Product category
     * $this->attributes['specs'] - array - Product specifications (JSON)
     * $this->attributes['image_urls'] - array - Product image URLs (JSON)
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - Record creation timestamp
     * $this->attributes['updated_at'] - \Illuminate\Support\Carbon - Record last update timestamp
     */

    // Attributes that are mass assignable.
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'category',
        'specs',
        'image_urls',
    ];

    // Attributes that should be cast to native types.
    protected $casts = [
        'specs' => 'array',
        'image_urls' => 'array',
    ];

    // Setters & getters.

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function getSpecs(): array
    {
        return json_decode($this->attributes['specs'] ?? '[]', true) ?? [];
    }

    public function setSpecs(array $specs): void
    {
        $this->attributes['specs'] = json_encode($specs);
    }

    public function getImageUrls(): array
    {
        return json_decode($this->attributes['image_urls'] ?? '[]', true) ?? [];
    }

    public function setImageUrls(array $image_urls): void
    {
        $this->attributes['image_urls'] = json_encode($image_urls);
    }

    // Util methods

    public function getFormattedPriceAttribute(): string
    {
        $price = $this->getPrice();

        $priceIntegers = intdiv($price, 100);
        $priceDecimals = $price % 100;

        return number_format($priceIntegers, 0, '', ',').'.'.str_pad($priceDecimals, 2, '0', STR_PAD_LEFT);
    }

    public function getFormattedSpecsAttribute(): array
    {
        $formattedSpecs = [];

        foreach ($this->getSpecs() ?? [] as $specName => $specValue) {
            $formattedSpecs[ucfirst($specName)] = $specValue;
        }

        return $formattedSpecs;
    }
}
