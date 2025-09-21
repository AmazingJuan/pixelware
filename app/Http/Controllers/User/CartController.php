<?php

/*
 * ProductController.php
 * Controller for managing products in the application.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {

        $products = Product::all()->keyBy(function ($p) {
            return (string) $p->id;
        });

        $cartProducts = [];
        $cartProductData = $request->session()->get('cart_product_data', []); 

        $total = 0;
        $totalQuantity = 0;

        if ($cartProductData) {
            foreach ($cartProductData as $id => $quantity) {
                if ($products->has($id)) {
                    $product = $products[$id];
                    $subtotal = $product->price * $quantity;

                    $cartProducts[] = [
                        'product'  => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];

                    $total += $subtotal;
                    $totalQuantity += $quantity;
                }
            }
        }

        $viewData = [];
        $viewData['cartProducts']   = $cartProducts;
        $viewData['total']          = $total;
        $viewData['totalQuantity']  = $totalQuantity;

        return view('user.cart.index')->with('viewData', $viewData);
    }


    public function add(string $id, Request $request): RedirectResponse
    {
        $quantity = (int) $request->input('quantity', 1);

        $cartProductData = $request->session()->get('cart_product_data', []);

        // Increments the quantity if it already existed, otherwise creates it
        $current = isset($cartProductData[$id]) ? (int) $cartProductData[$id] : 0;
        $cartProductData[$id] = $current + $quantity;

        $request->session()->put('cart_product_data', $cartProductData);

        return back();
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_product_data');

        return back();
    }
}
