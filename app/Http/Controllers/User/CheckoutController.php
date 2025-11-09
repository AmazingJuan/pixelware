<?php

/*
 * CheckoutController.php
 * Controller for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

// PHP native / global classes
use App\Helpers\CheckoutHelper;
// Laravel / Illuminate classes
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// App
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CheckoutController extends Controller
{
    protected CheckoutHelper $checkoutHelper;

    public function __construct(CheckoutHelper $checkoutHelper)
    {
        $this->checkoutHelper = $checkoutHelper;
    }

    public function index(Request $request): RedirectResponse
    {
        $cartData = $request->session()->get('cart_product_data', []);

        if (empty($cartData)) {
            return back()->withErrors(Lang::get('checkout.error.empty_cart'));
        }

        $user = Auth::user();
        if (! $user) {
            return back()->withErrors(Lang::get('checkout.error.unauthenticated'));
        }

        try {
            $order = $this->checkoutHelper->checkout($cartData, $user);

            return redirect()
                ->route('orders.show', ['order' => $order->getId()])
                ->with('success', Lang::get('checkout.success'));
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
