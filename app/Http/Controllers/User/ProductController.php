<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData = [];

        $products = $this->productRepository->all();
        $viewData['products'] = $products;

        return view('user.products.index', compact('viewData'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $productId): View
    {
        $product = $this->productRepository->find($productId);

        if ($product === null) {
            abort(404);
        }

        $viewData = [];
        $viewData['product'] = $product;

        return view('user.products.show', compact('viewData'));
    }
}
