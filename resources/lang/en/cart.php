<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */
    'cart' => [
        'title' => 'Your cart',
        'empty' => 'Your cart is empty.',

        'table' => [
            'product' => 'Product',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'subtotal' => 'Subtotal',
            'actions' => 'Actions',
            'remove_item' => 'Remove',
        ],

        'summary' => 'Order summary',
        'clear_cart' => 'Remove all',

        // trans_choice: singular | plural
        'total_label' => 'Total (:count item)|Total (:count items)',
        'total' => 'Total',
        'total_items' => 'Total items',

        'empty_button' => 'Empty cart',
        'checkout' => 'Proceed to checkout',
        'continue_shopping' => 'Continue shopping',

        'success' => [
            'added' => 'Product added to cart successfully.',
            'removed' => 'Product removed from cart successfully.',
            'removed_all' => 'All products removed from cart successfully.',
        ],

        'errors' => [
            'not_found' => 'Product not found in cart.',
        ],
    ],

];
