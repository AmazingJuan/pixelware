<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Review;
use App\Utils\MathUtils;

class ReviewHelper
{
    public static function createReview(array $data): Review
    {
        $review = Review::create($data);

        // Update product average rating
        $product = Product::findOrFail($data['product_id']);
        $newReviewsCount = $product->getReviewsCount() + 1;

        $newAverageRating = MathUtils::calculateNewAverage(
            $product->getAverageRating(),
            $data['rating'],
            $product->getReviewsCount()
        );

        $product->update([
            'average_rating' => $newAverageRating,
            'reviews_count' => $newReviewsCount,
        ]);

        return $review;
    }
}
