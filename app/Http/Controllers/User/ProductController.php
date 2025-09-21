<?php

/*
 * ProductController.php
 * Controller for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

// Laravel / framework
use Illuminate\View\View;

// App
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    // Repository instance for product data access
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
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
}
