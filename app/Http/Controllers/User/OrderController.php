<?php

/*
 * OrderController.php
 * Controller for managing the orders.
 * Author: Juan Jose Gomez & Santiago Manco
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    protected OrderRepository $orderRepository;

    protected ItemRepository $itemRepository;

    public function __construct(OrderRepository $orderRepository, ItemRepository $itemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository = $itemRepository;
    }

    public function index(): View
    {
        $userId = Auth::id();
        $orders = $this->orderRepository->getOrdersByUserId($userId);

        $viewData = [];
        $viewData['orders'] = $orders;

        return view('user.orders.index')->with('viewData', $viewData);
    }

    public function show(int $orderId): View
    {
        $order = $this->orderRepository->find($orderId);

        $items = $this->itemRepository->getItemsByOrderId($orderId);

        $viewData = [];
        $viewData['items'] = $items;
        $viewData['order'] = $order;

        return view('user.orders.show')->with('viewData', $viewData);
    }

    public function downloadPdf(int $orderId)
    {
        $order = $this->orderRepository->find($orderId);
        $items = $this->itemRepository->getItemsByOrderId($orderId);

        $viewData = [];
        $viewData['order'] = $order;
        $viewData['items'] = $items;

        $pdf = Pdf::loadView('user.orders.pdf', ['viewData' => $viewData]);

        return $pdf->download('order_'.$order->getId().'.pdf');
    }
}
