<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Product List
    |--------------------------------------------------------------------------
    */
    'list' => [
        'title' => 'Product List',
        'empty' => 'No products available.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Product Fields
    |--------------------------------------------------------------------------
    */
    'fields' => [
        'name' => 'Name',
        'price' => 'Price',
        'stock' => 'Stock',
        'out_of_stock' => 'Out of stock',
        'specs' => 'Specifications',
        'category' => 'Category',
        'no_specs' => 'No specifications available.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'view' => 'View product',
        'buy' => 'Buy',
        'back' => 'Back',
        'add_to_cart' => 'Add to cart',
        'more_info' => 'Get AI Powered Description',
    ],

    /*
    |--------------------------------------------------------------------------
    | Reviews
    |--------------------------------------------------------------------------
    */
    'reviews' => [
        'title' => 'Reviews',
        'empty' => 'No reviews yet.',

        'fields' => [
            'rating' => 'Rating',
            'select_rating' => 'Select a rating',
            'comment' => 'Comment',
        ],

        'actions' => [
            'submit' => 'Submit Review',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Ranking
    |--------------------------------------------------------------------------
    */

    'ranking' => [
        'title' => 'Top 3 Products by Rating',
        'empty' => 'No products available for ranking.',
    ],


];
