<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Default error messages used by the validator class. Some rules have multiple versions
    | such as size rules. You can tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute field must be accepted.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :attribute field must only contain letters and numbers.',
    'array' => 'The :attribute field must be an array.',
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute field must be a valid date.',
    'date_format' => 'The :attribute field must match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'integer' => 'The :attribute must be an integer.',
    'json' => 'The :attribute must be a valid JSON string.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'nullable' => 'The :attribute field can be null.',
    'numeric' => 'The :attribute must be a number.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute must match :other.',
    'string' => 'The :attribute must be a string.',
    'unique' => 'The :attribute has already been taken.',
    'url' => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Messages
    |--------------------------------------------------------------------------
    |
    | Define messages for attributes using "attribute.rule" convention
    |
    */
    'custom' => [
        // Users
        'username' => [
            'required' => 'Username is required.',
            'unique' => 'This username is already taken.',
        ],
        'email' => [
            'required' => 'Email is required.',
            'email' => 'Email must be a valid email address.',
            'unique' => 'This email is already registered.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'min' => 'Password must be at least :min characters.',
            'confirmed' => 'Password confirmation does not match.',
        ],
        'role' => [
            'required' => 'Role is required.',
            'in' => 'Role must be either admin or customer.',
        ],
        'balance' => [
            'required' => 'Balance is required.',
            'integer' => 'Balance must be an integer.',
            'numeric' => 'Balance must be a number.',
            'min' => 'Balance must be at least :min.',
        ],
        'address' => [
            'required' => 'Address is required.',
            'string' => 'Address must be a string.',
            'max' => 'Address may not be greater than :max characters.',
        ],

        // Products
        'name' => [
            'required' => 'Product name is required.',
            'string' => 'Product name must be a string.',
            'max' => 'Product name may not be greater than :max characters.',
        ],
        'description' => [
            'required' => 'Product description is required.',
            'string' => 'Product description must be a string.',
        ],
        'stock' => [
            'required' => 'Stock is required.',
            'integer' => 'Stock must be an integer.',
            'gte' => 'Stock must be at least :value.',
        ],
        'price' => [
            'required' => 'Price is required.',
            'numeric' => 'Price must be a number.',
            'gt' => 'Price must be greater than :value.',
        ],
        'category' => [
            'required' => 'Category is required.',
            'string' => 'Category must be a string.',
            'max' => 'Category may not be greater than :max characters.',
        ],
        'specs' => [
            'nullable' => 'Specifications can be null.',
            'string' => 'Specifications must be a string.',
            'json' => 'Specifications must be a valid JSON string.',
        ],
        'image' => [
            'required' => 'Product image is required.',
            'image' => 'Product image must be an image.',
            'mimes' => 'Product image must be a file of type: :values.',
            'max' => 'Product image may not be greater than :max kilobytes.',
        ],

        // Reviews
        'rating' => [
            'required' => 'Rating is required.',
            'integer' => 'Rating must be an integer.',
            'min' => 'Rating must be at least :min.',
            'max' => 'Rating may not be greater than :max.',
        ],
        'comment' => [
            'nullable' => 'Comment can be null.',
            'string' => 'Comment must be a string.',
            'max' => 'Comment may not be greater than :max characters.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Replace :attribute placeholder with readable names
    |
    */
    'attributes' => [
        // Users
        'username' => 'username',
        'email' => 'email',
        'password' => 'password',
        'role' => 'role',
        'balance' => 'balance',
        'address' => 'address',

        // Products
        'name' => 'product name',
        'description' => 'product description',
        'stock' => 'stock',
        'price' => 'price',
        'category' => 'category',
        'specs' => 'specifications',
        'image' => 'product image',

        // Reviews
        'rating' => 'rating',
        'comment' => 'comment',
    ],
];
