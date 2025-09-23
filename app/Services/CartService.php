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

    private function getItemsProducts($cartItemData)
    {
        // Retrieve cart items and calculate totals
        $productIds = array_keys($cartItemData);
        $products = $this->productRepository->getProductsByIds($productIds);

        return $products;
    }

    public function getCartItems($sessionCartData)
    {
        // Fetch products by IDs present in the cart
        $cartProducts = $this->getItemsProducts($sessionCartData);

        // Prepare detailed cart information
        $cartItems = [];

        foreach ($cartProducts as $cartProduct) {
            $cartItems[] = [
                'product' => $cartProduct,
                'quantity' => $sessionCartData[$cartProduct->id],
                'subtotal' => $cartProduct->price * $sessionCartData[$cartProduct->id],
                'formattedSubtotal' => PresentationUtils::formatCurrency($cartProduct->getPrice() * $sessionCartData[$cartProduct->getId()]),
            ];
        }

        return $cartItems;
    }

    public function getTotalPrice($cartItems, $needsFormatting = false)
    {
        // Calculate total price from cart items
        $totalPrice = 0;

        // Sum up subtotals
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem['subtotal'];
            unset($cartItem['subtotal']);
        }

        // Format total price if needed
        if ($needsFormatting) {
            return PresentationUtils::formatCurrency($totalPrice);
        }

        return $totalPrice;
    }

    public function getTotalQuantity($cartItems)
    {
        // Calculate total quantity from cart items
        $totalQuantity = 0;

        foreach ($cartItems as $cartItem) {
            $totalQuantity += $cartItem['quantity'];
        }

        return $totalQuantity;
    }
}
