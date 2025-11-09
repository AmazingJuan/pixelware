<?php

/*
 * AdminProductController.php
 * Controller for managing products in the admin panel.
 * Author: Juan Avendaño
 */

namespace App\Http\Controllers\Admin;

// Laravel / framework
use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreProductRequest;
use App\Http\Requests\AdminUpdateProductRequest;
use App\Models\Product;
// Requests
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
// Models & Helpers
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        $viewData = ['products' => $products];

        return view('admin.products.index', compact('viewData'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(AdminStoreProductRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        ProductHelper::create($validatedData);

        return redirect()->route('admin.products')
            ->with('success', Lang::get('admin.products.success.created'));
    }

    public function edit(int $productId): View
    {
        $product = Product::find($productId);

        if (! $product) {
            throw new ModelNotFoundException("Product with ID {$productId} not found.");
        }

        $viewData = ['product' => $product];

        return view('admin.products.edit', compact('viewData'));
    }

    public function update(AdminUpdateProductRequest $request, int $productId): RedirectResponse
    {
        $product = Product::find($productId);

        if (! $product) {
            throw new ModelNotFoundException("Product with ID {$productId} not found.");
        }

        $validatedData = $request->validated();

        ProductHelper::update($validatedData, $product);

        return redirect()->route('admin.products')
            ->with('success', Lang::get('admin.products.success.updated'));
    }

    public function destroy(int $productId): RedirectResponse
    {
        $product = Product::find($productId);

        if (! $product) {
            throw new ModelNotFoundException("Product with ID {$productId} not found.");
        }

        ProductHelper::destroy($product);

        return redirect()->route('admin.products')
            ->with('success', Lang::get('admin.products.success.deleted'));
    }
}
