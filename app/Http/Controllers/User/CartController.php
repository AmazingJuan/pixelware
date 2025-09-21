<?php

/*
 * ProductController.php
 * Controller for managing products in the application.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

// Laravel / framework
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

// App
use App\Http\Controllers\Controller;
use App\Services\CartService;

class CartController extends Controller
{
    // Service instance for cart operations
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request): View
    {
        // Retrieve cart product data from session
        $cartProductData = $request->session()->get('cart_product_data', []);

        // Get detailed cart products, total price, and total quantity using the CartService
        $cartProducts = $this->cartService->getCartProducts($cartProductData);
        $totalPrice = $this->cartService->getTotalPrice($cartProducts);
        $totalQuantity = $this->cartService->getTotalQuantity($cartProducts);

        // Prepare view data elements (cart products, total price, total quantity)
        $viewData = [];
        $viewData['cartProducts'] = $cartProducts;
        $viewData['totalPrice'] = $totalPrice;
        $viewData['totalQuantity'] = $totalQuantity;

        // Return the cart view with the prepared data
        return view('user.cart.index', compact('viewData'));
    }

    public function add(int $id, Request $request): RedirectResponse
    {
        // Get the quantity from the request, defaulting to 1 if not provided
        $quantity = (int) $request->input('quantity', 1);

        // Retrieve existing cart product data from session
        $cartProductData = $request->session()->get('cart_product_data', []);

        // Use the CartService to add the product to the cart
        $cartProductData = $this->cartService->add($cartProductData, $id, $quantity);

        // Update the session with the new cart product data
        $request->session()->put('cart_product_data', $cartProductData);

        // Redirect back to the cart page with a success message
        return redirect()->route('cart')->with('success', Lang::get('cart.success.added'));
    }

    public function removeAll(Request $request): RedirectResponse
    {
        // Clear all cart product data from the session
        $request->session()->forget('cart_product_data');

        // Redirect to the cart page with a success message
        return redirect()->route('cart')->with('success', Lang::get('cart.success.removed_all'));
    }

    public function remove(int $id, Request $request): RedirectResponse
    {
        // Retrieve existing cart product data from session
        $cartProductData = $request->session()->get('cart_product_data', []);

        // Check if the product exists in the cart
        if (isset($cartProductData[$id])) {
            // Remove the product from the cart data
            $request->session()->pull('cart_product_data', $id);

            // Redirect to the cart page with a success message
            return redirect()->route('cart')->with('success', Lang::get('cart.success.removed'));
        } else {
            // If the product was not found in the cart, redirect with an error message
            return redirect()->route('cart')->with('error', Lang::get('cart.error.not_found'));
        }
    }
}
