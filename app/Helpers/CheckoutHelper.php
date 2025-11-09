<?php

/*
 * CheckoutHelper.php
 * Helper for managing checkout and orders.
 * Author: Juan Jose Gomez
*/

namespace App\Helpers;

// Laravel / Illuminate classes
use App\Models\Order;
// App
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class CheckoutHelper
{
    public static function checkout(array $sessionCartData, User $user): Order
    {
        if (empty($sessionCartData)) {
            throw new Exception('Cart is empty.');
        }

        return DB::transaction(function () use ($sessionCartData, $user): Order {
            $cartItems = CartHelper::itemsFromSession($sessionCartData);
            $totalPrice = CartHelper::totalPrice(false);

            self::validateStock($cartItems);
            self::validateBalance($user, $totalPrice);

            $order = new Order;
            $order->user_id = $user->getId();
            $order->total = $totalPrice;
            $order->status = 'paid';
            $order->save();

            self::processOrderItems($order, $cartItems);

            $user->decreaseBalance($totalPrice);
            $user->save();

            CartHelper::clear();

            return $order;
        });
    }

    private static function validateStock(array $cartItems): void
    {
        foreach ($cartItems as $item) {
            $product = $item['product'];
            $qty = $item['quantity'];
            $stock = $product->getStock();

            if ($qty <= 0) {
                throw new Exception("Invalid quantity for product {$product->getName()}.");
            }

            if ($stock < $qty) {
                throw new Exception("Not enough stock for product {$product->getName()}. Requested: {$qty}, available: {$stock}.");
            }
        }
    }

    private static function validateBalance(User $user, float $total): void
    {
        if ($user->getBalance() < $total) {
            throw new Exception('Insufficient balance to complete the purchase.');
        }
    }

    private static function processOrderItems(Order $order, array $cartItems): void
    {
        foreach ($cartItems as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];

            $product->decreaseStock($quantity);
            $product->increaseTimesPurchased($quantity);
            $product->save();

            $order->items()->create([
                'product_id' => $product->getId(),
                'quantity' => $quantity,
                'unit_price' => $product->getPrice(),
            ]);
        }
    }
}
