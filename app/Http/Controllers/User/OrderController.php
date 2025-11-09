<?php

/*
 * OrderController.php
 * Controller for managing the orders.
 * Author: Juan Jose Gomez & Santiago Manco
*/

namespace App\Http\Controllers\User;

// PHP native / global classes
use App\Http\Controllers\Controller;
// Laravel / Illuminate classes
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
// App
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        // Get orders for the authenticated
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->get();

        $viewData = ['orders' => $orders];

        return view('user.orders.index', compact('viewData'));
    }

    public function show(int $orderId): View
    {
        try {
            // Retrieve order with its items and products
            $order = Order::with(['items.product'])->findOrFail($orderId);

            $viewData = [
                'order' => $order,
                'items' => $order->items,
            ];

            return view('user.orders.show', compact('viewData'));
        } catch (Exception $e) {
            abort(404, 'Order not found.');
        }
    }

    public function downloadPdf(int $orderId): Response
    {
        try {
            $order = Order::with(['items.product'])->findOrFail($orderId);

            $viewData = [
                'order' => $order,
                'items' => $order->items,
            ];

            $pdf = Pdf::loadView('user.orders.pdf', compact('viewData'));

            return $pdf->download('order_'.$order->id.'.pdf');
        } catch (Exception $e) {
            abort(404, 'Order not found.');
        }
    }
}
