<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

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
    'total' => 'Total',
    'total_items' => 'Total items',
    'checkout' => 'Proceed to checkout',
    'continue_shopping' => 'Continue shopping',
    'tips' => 'Secure checkout with encrypted payment',

    'modals' => [
        'remove_item' => [
            'title' => 'Remove Product',
            'message' => 'Are you sure you want to remove ":product" from your cart?',
        ],
        'clear_cart' => [
            'title' => 'Clear Cart',
            'message' => 'Are you sure you want to remove all products from your cart? This action cannot be undone.',
        ],
        'confirm' => 'Confirm',
        'cancel' => 'Cancel',
    ],

    'success' => [
        'added' => 'Product added to cart successfully.',
        'removed' => 'Product removed from cart successfully.',
        'removed_all' => 'All products removed from cart successfully.',
    ],

    'errors' => [
        'not_found' => 'Product not found in cart.',
    ],

];
