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
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'stock' => 'Stock',
            'category' => 'Category',
            'specs' => 'Specifications (JSON)',
            'image' => 'Product Image',
            'image_hint' => 'Upload a product image (JPEG, PNG).',
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
