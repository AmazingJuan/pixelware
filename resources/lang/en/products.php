<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    'list' => [
        'title' => 'Products',
        'empty' => 'No products available at the moment.',
        'low_stock' => 'Low stock',
        'total_products' => 'Showing :count products',
    ],

    'allied_list' => [
        'title' => 'Allied Products - Arslonga',
        'arslonga_link' => 'See more at Arslonga',
        'empty' => 'No allied products available at the moment.',
        'total_products' => 'Showing :count products',
    ],

    'show' => [
        'title' => 'Product Details',
        'description' => 'Description',
        'price' => 'Price',
        'stock' => 'Stock',
        'available' => 'Available',
        'out_of_stock' => 'Out of stock',
        'category' => 'Category',
        'add_to_cart' => 'Add to Cart',
        'specs' => 'Specifications',
        'no_specs' => 'No specifications available.',
        'out_of_stock_message' => 'This product is currently unavailable.',
        'reviews' => 'reviews',
        'no_image' => 'No image available',
    ],

    'fields' => [
        'name' => 'Name',
        'price' => 'Price',
        'stock' => 'Stock',
        'category' => 'Category',
        'specs' => 'Specifications',
    ],

    'actions' => [
        'view' => 'View',
        'view_details' => 'View Details',
        'add_to_cart' => 'Add to Cart',
        'buy' => 'Buy',
        'back' => 'Back',
        'go_home' => 'Go Home',
        'more_info' => 'Get AI Powered Description',
    ],

    'reviews' => [
        'title' => 'Reviews',
        'empty' => 'No reviews yet.',

        'fields' => [
            'rating' => 'Rating',
            'select_rating' => 'Select a rating',
            'comment' => 'Comment',
            'comment_placeholder' => 'Write your review here...',
            'max_characters' => 'Maximum 1000 characters.',
        ],

        'actions' => [
            'submit' => 'Submit Review',
        ],

        'write_review' => 'Write a Review',
        'login_required' => 'You must log in to leave a review.',
        'login_link' => 'Log in',
    ],

    'ranking' => [
        'title_rating' => 'Top Rated',
        'title_sales' => 'Best Sellers',
        'times_purchased' => 'Times Purchased',
        'empty' => 'No products available for ranking.',
        'sales_empty' => 'No sales data available.',
    ],
];
