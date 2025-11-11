<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title' => 'Admin Dashboard',
        'welcome' => 'Welcome to the admin dashboard. Here you can manage the app main resources.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    'users' => [
        'title' => 'User Management',
        'description' => 'Create, edit, and delete users.',

        'attributes' => [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'address' => 'Address',
            'balance' => 'Balance',
            'role' => 'Role',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
        ],

        'roles' => [
            'admin' => 'Admin',
            'customer' => 'Customer',
        ],

        'sections' => [
            'create' => 'Create a user',
            'edit' => 'Edit a user',
        ],

        'confirmations' => [
            'delete' => [
                'title' => 'Confirm Deletion',
                'message' => 'Are you sure you want to delete this user? This action cannot be undone.',
            ],
        ],

        'reminders' => [
            'keep_blank' => 'Leave blank to keep current',
        ],

        'empty' => 'No users to manage.',
        'success' => [
            'created' => 'User created successfully.',
            'updated' => 'User updated successfully.',
            'deleted' => 'User deleted successfully.',
        ],
        'errors' => [
            'not_found' => 'User not found.',
            'delete_failed' => 'Failed to delete user.',
            'create_failed' => 'Failed to create user.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */
    'products' => [
        'title' => 'Product Management',
        'description' => 'Create, edit, and delete products.',

        'attributes' => [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'stock' => 'Stock',
            'category' => 'Category',
            'specs' => 'Specifications',
            'image' => 'Product Image',
            'image_hint' => 'Upload a product image (JPEG, PNG).',
            'storage_driver' => 'Storage',
            'storage_driver_help' => 'Where do you want to store the image?: local o en GCP.',
        ],

        'placeholders' => [
            'spec_key' => 'GPU',
            'spec_value' => 'NVIDIA RTX 3080',
        ],

        'sections' => [
            'create' => 'Create a product',
            'edit' => 'Edit a product',
        ],

        'actions' => [
            'add_spec' => 'Add Specification',
        ],

        'empty' => 'No products to manage.',
        'out_of_stock' => 'Out of Stock',
        'success' => [
            'created' => 'Product created successfully.',
            'updated' => 'Product updated successfully.',
            'deleted' => 'Product deleted successfully.',
        ],
        'errors' => [
            'not_found' => 'Product not found.',
            'delete_failed' => 'Failed to delete product.',
            'create_failed' => 'Failed to create product.',
        ],
        'confirmations' => [
            'delete' => [
                'title' => 'Confirm Deletion',
                'message' => 'Are you sure you want to delete this product? This action cannot be undone.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Common
    |--------------------------------------------------------------------------
    */
    'common' => [
        'save' => 'Save',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
        'confirm' => 'Confirm',
        'actions_title' => 'Actions',
        'back' => 'Go Back',
        'update' => 'Update',
        'create' => 'Create',
    ],

];
