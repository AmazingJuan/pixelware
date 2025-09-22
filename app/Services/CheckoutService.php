<?php

/*
 * CheckoutService.php
 * Service for managing the checkout.
 * Author: Juan Jose Gomez
*/

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function checkout(array $cartProductData, User $user): Order
    {
        if (empty($cartProductData)) {
            throw new Exception('Cart is empty.');
        }

        return DB::transaction(function () use ($cartProductData, $user) {

            // Load products in cart
            $productIds = array_keys($cartProductData);
            $products = Product::whereIn('id', $productIds)->get()->keyBy(function ($p) {
                return (string) $p->getId();
            });

            $total = 0;

            // Validations of stock
            foreach ($cartProductData as $pid => $qty) {
                $pidStr = (string) $pid;

                if (! $products->has($pidStr)) {
                    throw new Exception("Product with id {$pid} not found.");
                }

                $product = $products[$pidStr];

                $price = $product->getPrice();
                $stock = $product->getStock();

                if ($qty <= 0) {
                    throw new Exception("Invalid quantity for product {$product->getName()}.");
                }

                if ($stock < $qty) {
                    throw new Exception("Not enough stock for product {$product->getName()}. Requested: {$qty}, available: {$stock}.");
                }

                $total += $price * $qty;
            }

            // User's balance validation
            $userBalance = $user->getBalance();
            if ($userBalance < $total) {
                throw new Exception("Insufficient balance. Order total: {$total}, your balance: {$userBalance}.");
            }

            // Order creation
            $order = new Order;
            $order->setUserId($user->getId());
            $order->setTotal($total);
            $order->save();

            // Stock reduction and order items creation
            foreach ($cartProductData as $pid => $qty) {
                $pidStr = (string) $pid;
                $product = $products[$pidStr];

                $product->setStock($product->getStock() - $qty);
                $product->save();

                $item = new Item;
                $item->setQuantity($qty);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());

                $order->items()->save($item);
            }

            // Balance reduction of the user
            $user->setBalance($user->getBalance() - $total);
            $user->save();

            $order->setStatus('paid');
            $order->save();

            return $order;
        });
    }
}
