<?php

/*
 * CheckoutService.php
 * Service for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Services;

// PHP native / global classes
use App\Models\Order;
// Laravel / Illuminate classes
use App\Models\User;
// Application / App
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    // Repository and Service instances for order management
    protected CartService $cartService;

    protected OrderRepository $orderRepository;

    protected ProductRepository $productRepository;

    protected ItemRepository $itemRepository;

    protected UserRepository $userRepository;

    public function __construct(CartService $cartService, OrderRepository $orderRepository,
        ProductRepository $productRepository, ItemRepository $itemRepository, UserRepository $userRepository)
    {
        $this->cartService = $cartService;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->itemRepository = $itemRepository;
        $this->userRepository = $userRepository;
    }

    private function validateStock(array $cartItems): void
    {
        // Validate stock for each item in the cart
        foreach ($cartItems as $cartItem) {
            // Get quantity and product details
            $qty = $cartItem['quantity'];

            // Get product details
            $product = $cartItem['product'];

            // Validate stock availability
            $stock = $product->getStock();

            // Check for invalid quantity or insufficient stock
            if ($qty <= 0) {
                throw new Exception("Invalid quantity for product {$product->getName()}.");
            }

            // Check if requested quantity exceeds available stock
            if ($stock < $qty) {
                throw new Exception("Not enough stock for product {$product->getName()}. Requested: {$qty}, available: {$stock}.");
            }
        }
    }

    private function validateBalance(User $user, int $total): void
    {
        // Validate if the user has enough balance for the purchase
        $userBalance = $user->getBalance();

        if ($userBalance < $total) {
            throw new Exception('Insufficient balance to complete the purchase.');
        }
    }

    private function processOrderItems(Order $order, array $cartItems): Order
    {
        foreach ($cartItems as $item) {
            // Reduce stock and increase times purchased
            $item['product']->decreaseStock($item['quantity']);
            $item['product']->increaseTimesPurchased($item['quantity']);
            $this->productRepository->save($item['product']);

            // Create order item
            $this->itemRepository->create([
                'order_id' => $order->getId(),
                'product_id' => $item['product']->getId(),
                'quantity' => $item['quantity'],
                'unit_price' => $item['product']->getPrice(),
            ]); // Using repository pattern for creating order items
        }

        $order = $this->orderRepository->refresh($order); // Reload order with items

        return $order;
    }

    public function checkout(array $sessionCartData, User $user): Order
    {
        // Ensure the cart is not empty
        if (empty($sessionCartData)) {
            throw new Exception('Cart is empty.');
        }

        return DB::transaction(function () use ($sessionCartData, $user) {
            // Load items in cart
            $cartItems = $this->cartService->getCartItems($sessionCartData);

            // Gathers total price
            $totalPrice = $this->cartService->getTotalPrice($cartItems);

            // Validations of stock
            $this->validateStock($cartItems);

            // User's balance validation
            $this->validateBalance($user, $totalPrice);

            // Order creation
            $order = $this->orderRepository->create([
                'user_id' => $user->getId(),
                'total' => $totalPrice,
            ]);

            // Stock reduction and order items creation
            $order = $this->processOrderItems($order, $cartItems);

            // Balance reduction of the user
            $user->decreaseBalance($totalPrice);
            $this->userRepository->save($user);

            // Mark order as paid
            $this->orderRepository->update(['status' => 'paid'], $order);

            return $order;
        });
    }
}
