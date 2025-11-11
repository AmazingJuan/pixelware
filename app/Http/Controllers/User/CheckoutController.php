<?php

/*
 * CheckoutController.php
 * Controller for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

use App\Helpers\CartHelper;
use App\Helpers\CheckoutHelper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CheckoutController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $cartData = CartHelper::all();

        if (empty($cartData)) {
            return back()->withErrors(Lang::get('checkout.errors.empty_cart'));
        }

        $user = Auth::user();
        if (! $user) {
            return back()->withErrors(Lang::get('checkout.error.unauthenticated'));
        }

        try {
            $order = CheckoutHelper::checkout($cartData, $user);

            return redirect()
                ->route('orders.show', ['order' => $order->getId()])
                ->with('success', Lang::get('checkout.success'));
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
