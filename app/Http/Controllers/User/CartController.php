<?php

/*
 * CartController.php
 * Controller for managing the home page in the application.
 * Author: Juan Jose
*/

namespace App\Http\Controllers\User;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'cartItems' => CartHelper::items(),
            'totalPrice' => CartHelper::totalPrice(true),
            'totalQuantity' => CartHelper::totalQuantity(),
        ];

        return view('user.cart.index', compact('viewData'));
    }

    public function add(int $id, Request $request): RedirectResponse
    {
        $quantity = $request->input('quantity', 1);
        CartHelper::add($id, $quantity);

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.added'));
    }

    public function remove(int $id): RedirectResponse
    {
        CartHelper::remove($id);

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.removed'));
    }

    public function removeAll(): RedirectResponse
    {
        CartHelper::clear();

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.removed_all'));
    }
}
