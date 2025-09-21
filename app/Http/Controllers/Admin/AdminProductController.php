<?php

/*
 * AdminProductController.php
 * Controller for managing products in the admin panel.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\Admin;

// Laravel / framework
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

// App
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreProductRequest;
use App\Http\Requests\AdminUpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

class AdminProductController extends Controller
{
    protected ProductRepository $productRepository;

    protected ProductService $productService;

    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * Display a listing of products.
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
        return view('admin.products.index', compact('viewData'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product record and image using services.
     */
    public function store(AdminStoreProductRequest $request)
    {
        // Gather validated data
        $validatedData = $request->validated();
        
        // Create product using service (which also manages image storage)
        $this->productService->create($validatedData);

        // Redirect to products list with success message
        return redirect()->route('admin.products')->with('success', Lang::get('admin.products.success.created'));
    }

    public function destroy(int $productId)
    {

        // Find product by ID
        $product = $this->productRepository->find($productId);

        // If product not found, redirect with error
        if (! $product) {
            return redirect()->route('admin.products')->with('error', Lang::get('admin.products.errors.not_found'));
        }

        // Use service to delete product and its images
        $deleted = $this->productService->destroy($product);

        // If deletion failed, redirect with error
        if (! $deleted) {
            return redirect()->route('admin.products')->with('error', Lang::get('admin.products.errors.delete_failed'));
        }

        // Redirect to products list with success message
        return redirect()->route('admin.products')->with('success', Lang::get('admin.products.success.deleted'));
    }

    public function edit(int $productId): View | RedirectResponse
    {
        // Create an array to hold view data
        $viewData = [];

        // Retrieve the product by ID
        $product = $this->productRepository->find($productId);
        
        // If product not found, redirect with error
        if (! $product) {
            return redirect()->route('admin.products')->with('error', Lang::get('admin.products.errors.not_found'));
        }
        // Add product to the view data array
        $viewData['product'] = $product;

        // Return the view with the view data
        return view('admin.products.edit', compact('viewData'));
    }

    public function update(AdminUpdateProductRequest $request, int $productId)
    {
        // Retrieve the product by ID
        $product = $this->productRepository->find($productId);

        // If product not found, redirect with error
        if (! $product) {
            return redirect()->route('admin.products')->with('error', Lang::get('admin.products.errors.not_found'));
        }

        // Gather validated data
        $validatedData = $request->validated();

        // Update product using service (which also manages image update if provided)
        $this->productService->update($validatedData, $product);

        // Redirect to products list with success message
        return redirect()->route('admin.products')->with('success', Lang::get('admin.products.success.updated'));
    }
}
