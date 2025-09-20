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

];
