<?php

/*
 * Review.php
 * Model for managing product reviews in the application.
 * Author: Juan Avendaño
*/

namespace App\Models;

// Laravel / Illuminate classes
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Review extends Model
{
    /**
     * Attributes:
     *
     * $this->attributes['id']         - int                        - Primary key identifier
     * $this->attributes['comment']    - string                     - Review comment
     * $this->attributes['rating']     - int                        - Review rating (1-5)
     * $this->attributes['user_id']    - int                        - Reviewer user ID
     * $this->attributes['product_id'] - int                        - Reviewed product ID
     * $this->attributes['created_at'] - \Illuminate\Support\Carbon - Review creation timestamp
     */
    protected $fillable = [
        'comment',
        'rating',
        'user_id',
        'product_id',
    ];

    public $timestamps = false;

    // Getters.

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    // Setters.

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setComment(string $comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    // Relationships.

    // User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    // Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
