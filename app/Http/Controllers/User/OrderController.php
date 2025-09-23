<?php

/*
 * OrderController.php
 * Controller for managing the orders.
 * Author: Juan Jose Gomez & Santiago Manco
*/

namespace App\Http\Controllers\User;

// Third-party / packages
use App\Http\Controllers\Controller;
// Laravel / framework
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
// App
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    // Repository instances for order and item management
    protected OrderRepository $orderRepository;

    protected ItemRepository $itemRepository;

    public function __construct(OrderRepository $orderRepository, ItemRepository $itemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository = $itemRepository;
    }

    public function index(): View
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve orders for the authenticated user
        $orders = $this->orderRepository->getOrdersByUserId($userId);

        // Prepare view data
        $viewData = [];
        $viewData['orders'] = $orders;

        // Return the orders view with the prepared data
        return view('user.orders.index')->with('viewData', $viewData);
    }

    public function show(int $orderId): View
    {
        // Find the order by ID using the repository
        $order = $this->orderRepository->find($orderId);

        // Get items associated with the order
        $items = $this->itemRepository->getItemsByOrderId($orderId);

        // Prepare view data
        $viewData = [];
        $viewData['items'] = $items;
        $viewData['order'] = $order;

        // Return the order details view with the prepared data
        return view('user.orders.show')->with('viewData', $viewData);
    }

    public function downloadPdf(int $orderId)
    {
        // Find the order and its items
        $order = $this->orderRepository->find($orderId);
        $items = $this->itemRepository->getItemsByOrderId($orderId);

        // Prepare view data for the PDF
        $viewData = [];
        $viewData['order'] = $order;
        $viewData['items'] = $items;

        // Generate the PDF from the view
        $pdf = Pdf::loadView('user.orders.pdf', ['viewData' => $viewData]);

        return $pdf->download('order_'.$order->getId().'.pdf');
    }
}
