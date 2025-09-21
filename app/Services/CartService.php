<?php

/*
 * CartService.php
 * Service for managing the shopping cart.
 * Author: Juan Avendaño & Juan Jose Gomez
*/

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Utils\PresentationUtils;

class CartService
{
    // Repository for accessing product data
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function add($sessionCartData, $id, $quantity)
    {
        // Update the product quantity in the cart
        $sessionCartData[$id] = ($sessionCartData[$id] ?? 0) + $quantity;

        return $sessionCartData;
    }

    public function getCartProducts($cartProductData)
    {
        // Fetch products by IDs present in the cart
        $productIds = array_keys($cartProductData);
        $products = $this->productRepository->getProductsByIds($productIds);

        // Prepare detailed cart information
        $cartInfo = [];

        foreach ($products as $product) {
            $cartInfo[] = [
                'product' => $product,
                'quantity' => $cartProductData[$product->id],
                'subtotal' => $product->price * $cartProductData[$product->id],
                'formattedSubtotal' => PresentationUtils::formatCurrency($product->getPrice() * $cartProductData[$product->getId()]),
            ];
        }

        return $cartInfo;
    }

    public function getTotalPrice($cartInfo)
    {
        // Calculate total price from cart items
        $totalPrice = 0;

        // Sum up subtotals
        foreach ($cartInfo as $item) {
            $totalPrice += $item['subtotal'];

            unset($item['subtotal']);
        }

        // Format total price for display
        $formattedTotalPrice = PresentationUtils::formatCurrency($totalPrice);

        return $formattedTotalPrice;
    }

    public function getTotalQuantity($cartProducts)
    {
        // Calculate total quantity from cart items
        $totalQuantity = 0;

        foreach ($cartProducts as $item) {
            $totalQuantity += $item['quantity'];
        }

        return $totalQuantity;
    }
}
