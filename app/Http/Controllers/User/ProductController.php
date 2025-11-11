<?php

/*
 * ProductController.php
 * Controller for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

// Laravel / Illuminate classes
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Utils\AIUtils;
use Illuminate\Http\JsonResponse;
// Models
use Illuminate\Support\Facades\Lang;
// Utils / Helpers
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        // Retrieve all products with reviews
        $products = Product::with('reviews')->get();
        $viewData = ['products' => $products];

        return view('user.products.index', compact('viewData'));
    }

    public function show(int $productId): View
    {
        // Find the product by ID with reviews
        $product = Product::with('reviews')->findOrFail($productId);

        $viewData = [
            'product' => $product,
            'productReviews' => $product->getReviews(),
        ];

        return view('user.products.show', compact('viewData'));
    }

    public function moreInfo(int $productId): JsonResponse
    {
        $product = Product::find($productId);

        if (! $product) {
            return response()->json(['error' => Lang::get('exceptions.product_not_found')], 404);
        }

        $aiDescription = AIUtils::generateProductDescription(
            $product->getName(),
            $product->getDescription()
        );

        return response()->json(['description' => $aiDescription]);
    }

    public function rankingRating(): View
    {
        $products = Product::TopThreeRating()->get();

        $viewData = ['products' => $products];

        return view('user.products.ranking.rating', compact('viewData'));
    }

    public function rankingSales(): View
    {
        $products = Product::TopThreeSales()->get();

        $viewData = ['products' => $products];

        return view('user.products.ranking.sales', compact('viewData'));
    }
}
