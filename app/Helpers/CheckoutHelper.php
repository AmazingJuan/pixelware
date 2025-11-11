<?php

/*
 * CheckoutHelper.php
 * Helper for managing checkout and orders.
 * Author: Juan Jose Gomez
*/

namespace App\Helpers;

use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CheckoutHelper
{
    public static function checkout(array $sessionCartData, User $user): Order
    {
        if (empty($sessionCartData)) {
            throw new Exception(Lang::get('exceptions.cart_empty'));
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
                throw new Exception(Lang::get('exceptions.invalid_quantity', [
                    'product' => $product->getName(),
                ]));
            }

            if ($stock < $qty) {
                throw new Exception(Lang::get('exceptions.not_enough_stock', [
                    'product' => $product->getName(),
                    'qty' => $qty,
                    'stock' => $stock,
                ]));
            }
        }
    }

    private static function validateBalance(User $user, float $total): void
    {
        if ($user->getBalance() < $total) {
            throw new Exception(Lang::get('exceptions.insufficient_balance'));
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
