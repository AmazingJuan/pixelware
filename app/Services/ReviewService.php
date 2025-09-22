<?php

/*
 * ReviewService.php
 * Service for managing product reviews business logic.
 * Author: Juan Avendaño
*/

namespace App\Services;

use App\Models\Review;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;
use App\Utils\MathUtils;

class ReviewService
{
    protected ReviewRepository $reviewRepository;

    protected ProductRepository $productRepository;

    public function __construct(ReviewRepository $reviewRepository, ProductRepository $productRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Create a new review and update the associated product's average rating and reviews count.
     */
    public function createReview(array $data): Review
    {
        // Create review
        $review = $this->reviewRepository->create($data);

        // Gather util data for rating update
        $productId = $data['product_id'];
        $product = $this->productRepository->find($productId);
        $newReviewsCount = $product->getReviewsCount() + 1;

        // Calculate new average rating
        $newAverageRating = MathUtils::calculateNewAverage(
            $product->getAverageRating(),
            $data['rating'],
            $product->getReviewsCount()
        );

        // Create updatable product data
        $updatableProductData = [
            'average_rating' => $newAverageRating,
            'reviews_count' => $newReviewsCount,
        ];

        // Update product
        $this->productRepository->update($updatableProductData, $product);

        // Return created review
        return $review;
    }
}
