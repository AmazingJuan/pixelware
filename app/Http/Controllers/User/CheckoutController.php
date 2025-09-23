<?php

/*
 * CheckoutController.php
 * Controller for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

// PHP native / global classes
use App\Http\Controllers\Controller;
// Laravel / framework
use App\Services\OrderService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// Application / App
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CheckoutController extends Controller
{
    // Service instance for order operations
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): RedirectResponse
    {
        // Retrieve cart product data from session
        $sessionCartData = $request->session()->get('cart_product_data', []);

        // Check if the cart is empty
        if (empty($sessionCartData)) {
            return back()->withErrors(Lang::get('checkout.error.empty_cart'));
        }

        // Get the authenticated user
        $user = Auth::user();

        try {
            // Process the checkout and create the order (remember this is an atomic operation)
            $order = $this->orderService->checkout($sessionCartData, $user);

            // Clear cart
            $request->session()->forget('cart_product_data');

            // Redirect to the order details page with a success message
            return redirect()->route('orders.show', ['order' => $order->getId()])->with('success', Lang::get('checkout.success'));
        } catch (Exception $e) {
            // Handle any exceptions that occur during checkout

            return back()->withErrors($e->getMessage());
        }
    }
}
