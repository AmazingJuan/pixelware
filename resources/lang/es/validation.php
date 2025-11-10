<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_dash' => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y números.',
    'array' => 'El campo :attribute debe ser un arreglo.',
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_format' => 'El campo :attribute no coincide con el formato :format.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'file' => 'El archivo :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
        'file' => 'El archivo :attribute debe ser mayor o igual que :value kilobytes.',
        'string' => 'El campo :attribute debe tener al menos :value caracteres.',
        'array' => 'El campo :attribute debe tener :value elementos o más.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es válido.',
    'integer' => 'El campo :attribute debe ser un entero.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file' => 'El archivo :attribute no puede ser mayor que :max kilobytes.',
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
        'array' => 'El campo :attribute no puede tener más de :max elementos.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El archivo :attribute debe tener al menos :min kilobytes.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'nullable' => 'El campo :attribute puede ser nulo.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values está presente.',
    'same' => 'El campo :attribute y :other deben coincidir.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'unique' => 'El campo :attribute ya ha sido tomado.',
    'url' => 'El formato de :attribute no es válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Messages
    |--------------------------------------------------------------------------
    */
    'custom' => [
        // Users
        'username' => [
            'required' => 'El nombre de usuario es obligatorio.',
            'unique' => 'Este nombre de usuario ya está en uso.',
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'email' => 'El correo debe ser una dirección de correo válida.',
            'unique' => 'Este correo ya está registrado.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'min' => 'La contraseña debe tener al menos :min caracteres.',
            'confirmed' => 'La confirmación de la contraseña no coincide.',
        ],
        'role' => [
            'required' => 'El rol es obligatorio.',
            'in' => 'El rol debe ser admin o customer.',
        ],
        'balance' => [
            'required' => 'El saldo es obligatorio.',
            'integer' => 'El saldo debe ser un entero.',
            'numeric' => 'El saldo debe ser un número.',
            'min' => 'El saldo debe ser al menos :min.',
        ],
        'address' => [
            'required' => 'La dirección es obligatoria.',
            'string' => 'La dirección debe ser una cadena de texto.',
            'max' => 'La dirección no puede tener más de :max caracteres.',
        ],

        // Products
        'name' => [
            'required' => 'El nombre del producto es obligatorio.',
            'string' => 'El nombre del producto debe ser una cadena de texto.',
            'max' => 'El nombre del producto no puede tener más de :max caracteres.',
        ],
        'description' => [
            'required' => 'La descripción del producto es obligatoria.',
            'string' => 'La descripción del producto debe ser una cadena de texto.',
        ],
        'stock' => [
            'required' => 'El stock es obligatorio.',
            'integer' => 'El stock debe ser un entero.',
            'gte' => 'El stock debe ser al menos :value.',
        ],
        'price' => [
            'required' => 'El precio es obligatorio.',
            'numeric' => 'El precio debe ser un número.',
            'gt' => 'El precio debe ser mayor que :value.',
        ],
        'category' => [
            'required' => 'La categoría es obligatoria.',
            'string' => 'La categoría debe ser una cadena de texto.',
            'max' => 'La categoría no puede tener más de :max caracteres.',
        ],
        'specs' => [
            'nullable' => 'Las especificaciones pueden ser nulas.',
            'string' => 'Las especificaciones deben ser una cadena JSON.',
            'json' => 'Las especificaciones deben ser una cadena JSON válida.',
        ],
        'image' => [
            'required' => 'La imagen del producto es obligatoria.',
            'image' => 'La imagen del producto debe ser una imagen.',
            'mimes' => 'La imagen del producto debe ser un archivo de tipo: :values.',
            'max' => 'La imagen del producto no puede ser mayor que :max kilobytes.',
        ],

        // Reviews
        'rating' => [
            'required' => 'La calificación es obligatoria.',
            'integer' => 'La calificación debe ser un entero.',
            'min' => 'La calificación debe ser al menos :min.',
            'max' => 'La calificación no puede ser mayor que :max.',
        ],
        'comment' => [
            'nullable' => 'El comentario puede ser nulo.',
            'string' => 'El comentario debe ser una cadena de texto.',
            'max' => 'El comentario no puede tener más de :max caracteres.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        // Users
        'username' => 'nombre de usuario',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'role' => 'rol',
        'balance' => 'saldo',
        'address' => 'dirección',

        // Products
        'name' => 'nombre del producto',
        'description' => 'descripción del producto',
        'stock' => 'stock',
        'price' => 'precio',
        'category' => 'categoría',
        'specs' => 'especificaciones',
        'image' => 'imagen del producto',

        // Reviews
        'rating' => 'calificación',
        'comment' => 'comentario',
    ],
];
