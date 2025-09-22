<?php

/*
 * OrderController.php
 * Controller for managing the orders.
 * Author: Juan Jose Gomez
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())->with('items.product')->get();

        $viewData = [];
        $viewData['orders'] = $orders;

        return view('user.orders.index')->with('viewData', $viewData);
    }

    public function show(int $orderId): View
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($orderId);

        $items = $order->items->map(function ($item) {
            $qty = $item->getQuantity();
            $unitPrice = $item->formatted_price;
            $subtotal = $unitPrice * $qty;

            return [
                'name' => $item->product->getName(),
                'quantity' => $qty,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ];
        });

        $viewData = [];
        $viewData['items'] = $items;
        $viewData['order'] = $order;

        return view('user.orders.show')->with('viewData', $viewData);
    }
}
