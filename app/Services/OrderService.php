<?php

/*
 * CheckoutService.php
 * Service for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
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
        foreach ($cartItems as $cartItem) {
            $qty = $cartItem['quantity'];

            $product = $cartItem['product'];

            $stock = $product->getStock();

            if ($qty <= 0) {
                throw new Exception("Invalid quantity for product {$product->getName()}.");
            }

            if ($stock < $qty) {
                throw new Exception("Not enough stock for product {$product->getName()}. Requested: {$qty}, available: {$stock}.");
            }
        }
    }

    private function validateBalance(User $user, int $total): void
    {
        $userBalance = $user->getBalance();

        if ($userBalance < $total) {
            throw new Exception('Insufficient balance to complete the purchase.');
        }
    }

    private function processOrderItems(Order $order, array $cartItems): Order
    {
        foreach ($cartItems as $item) {

            $item['product']->decreaseStock($item['quantity']);
            $item['product']->save(); // Here we're not using repository pattern because repo pattern doesn't allow  business logic

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
