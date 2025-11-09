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
    protected CartHelper $cartHelper;

    public function __construct(CartHelper $cartHelper)
    {
        $this->cartHelper = $cartHelper;
    }

    public function index(): View
    {
        $viewData = [
            'cartItems' => $this->cartHelper->items(),
            'totalPrice' => $this->cartHelper->totalPrice(true),
            'totalQuantity' => $this->cartHelper->totalQuantity(),
        ];

        return view('user.cart.index', compact('viewData'));
    }

    public function add(int $id, Request $request): RedirectResponse
    {
        $quantity = (int) $request->input('quantity', 1);
        $this->cartHelper->add($id, $quantity);

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.added'));
    }

    public function remove(int $id): RedirectResponse
    {
        $this->cartHelper->remove($id);

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.removed'));
    }

    public function removeAll(): RedirectResponse
    {
        $this->cartHelper->clear();

        return redirect()
            ->route('cart')
            ->with('success', Lang::get('cart.success.removed_all'));
    }
}
