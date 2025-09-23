<?php

/*
 * CheckoutController.php
 * Controller for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CheckoutController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): RedirectResponse
    {
        // Retrieve cart product data from session
        $sessionCartData = $request->session()->get('cart_product_data', []);

        if (empty($sessionCartData)) {
            return back()->withErrors(Lang::get('checkout.error.empty_cart'));
        }

        $user = Auth::user();

        try {
            $order = $this->orderService->checkout($sessionCartData, $user);

            // Clear cart
            $request->session()->forget('cart_product_data');

            return redirect()->route('orders.show', ['order' => $order->getId()])->with('success', Lang::get('checkout.success'));
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
