<?php

/*
 * ProductController.php
 * Controller for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

// Laravel / framework
use App\Http\Controllers\Controller;

// App
use App\Repositories\ProductRepository;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    // Repository instance for product data access
    protected ProductRepository $productRepository;

    // Service instance for OpenAI interactions
    protected OpenAIService $openAIService;

    public function __construct(ProductRepository $productRepository, OpenAIService $openAIService)
    {
        $this->productRepository = $productRepository;
        $this->openAIService = $openAIService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Create an array to hold view data
        $viewData = [];

        // Retrieve all products from the repository
        $products = $this->productRepository->all();

        // Add products to the view data array
        $viewData['products'] = $products;

        // Return the view with the view data
        return view('user.products.index', compact('viewData'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $productId): View
    {
        // Find the product by ID using the repository
        $product = $this->productRepository->find($productId);

        // If the product is not found, abort with a 404 error
        if ($product === null) {
            abort(404);
        }

        // Prepare view data elements (product details and reviews)
        $viewData = [];
        $viewData['product'] = $product;

        // Fetch product associated reviews
        $viewData['productReviews'] = $product->getReviews();

        // Return the product detail view with the prepared data
        return view('user.products.show', compact('viewData'));
    }

    public function moreInfo(int $productId): JsonResponse
    {
        // Find the product by ID using the repository
        $product = $this->productRepository->find($productId);

        // If the product is not found, return a 404 JSON response
        if (! $product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Generate additional product information using OpenAI service
        $aiDescription = $this->openAIService->generateProductDescription(
            $product->getName(),
            $product->getDescription()
        );

        // Return the AI-generated description as a JSON response
        return response()->json(['description' => $aiDescription]);
    }

    public function rankingRating(): View
    {
        // Create an array to hold view data
        $viewData = [];
        $products = $this->productRepository->topThreeRating();
        $viewData['products'] = $products;

        // Return the view with the view data
        return view('user.products.ranking.rating', compact('viewData'));
    }

    public function rankingSales(): View
    {
        // Create an array to hold view data
        $viewData = [];
        $products = $this->productRepository->topThreeSales();
        $viewData['products'] = $products;

        // Return the view with the view data
        return view('user.products.ranking.sales', compact('viewData'));
    }
}
