<?php

/*
 * CartHelper.php
 * Helper for managing shopping cart operations.
 * Author: Juan Avendaño
*/

namespace App\Helpers;

// Laravel / framework
use App\Models\Product;
// Models
use App\Utils\PresentationUtils;
// Utils / Helpers
use Illuminate\Support\Facades\Session;

class CartHelper
{
    protected static string $sessionKey = 'cart_product_data';

    public static function all(): array
    {
        return Session::get(self::$sessionKey, []);
    }

    public static function add(int $id, int $quantity = 1): void
    {
        $cart = self::all();
        $cart[$id] = ($cart[$id] ?? 0) + $quantity;
        Session::put(self::$sessionKey, $cart);
    }

    public static function remove(int $id): void
    {
        $cart = self::all();
        unset($cart[$id]);
        Session::put(self::$sessionKey, $cart);
    }

    public static function clear(): void
    {
        Session::forget(self::$sessionKey);
    }

    public static function items(): array
    {
        $cart = self::all();

        if (empty($cart)) {
            return [];
        }

        $products = Product::findMany(array_keys($cart));

        return $products->map(function (Product $product) use ($cart): array {
            $quantity = $cart[$product->id];
            $subtotal = $product->price * $quantity;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'formattedSubtotal' => PresentationUtils::formatCurrency($subtotal),
            ];
        })->toArray();
    }

    public static function totalPrice(bool $formatted = false): float|string
    {
        $total = (float) array_sum(array_column(self::items(), 'subtotal'));

        return $formatted
            ? PresentationUtils::formatCurrency($total)
            : $total;
    }

    public static function totalQuantity(): int
    {
        return (int) array_sum(array_column(self::items(), 'quantity'));
    }

    public static function itemsFromSession(array $sessionCartData): array
    {
        if (empty($sessionCartData)) {
            return [];
        }

        $products = Product::findMany(array_keys($sessionCartData));

        return $products->map(function (Product $product) use ($sessionCartData): array {
            $quantity = $sessionCartData[$product->id];
            $subtotal = (float) $product->price * $quantity;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'formattedSubtotal' => PresentationUtils::formatCurrency($subtotal),
            ];
        })->toArray();
    }
}
