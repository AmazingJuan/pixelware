<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Messages
    |--------------------------------------------------------------------------
    */
    'product_not_found' => 'Product with ID :id not found.',
    'user_not_found' => 'User with ID :id not found.',
    'order_not_found' => 'Order not found.',
    'cart_empty' => 'Cart is empty.',
    'invalid_quantity' => 'Invalid quantity for product :product.',
    'not_enough_stock' => 'Not enough stock for product :product. Requested: :qty, available: :stock.',
    'insufficient_balance' => 'Insufficient balance to complete the purchase.',
    'image_local_store_failed' => 'Failed to store the image locally.',
    'image_bucket_not_found' => 'The bucket :bucket does not exist on GCP.',
];
