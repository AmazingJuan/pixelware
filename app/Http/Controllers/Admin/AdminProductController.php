<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(): View
    {
        $viewData = [];

        $products = $this->productRepository->all();

        $viewData['products'] = $products;

        return view('admin.products.index', compact('viewData'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }
}
