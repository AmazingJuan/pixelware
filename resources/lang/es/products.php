<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Productos
    |--------------------------------------------------------------------------
    */

    'list' => [
        'title' => 'Productos',
        'empty' => 'No hay productos disponibles en este momento.',
        'low_stock' => 'Poco stock',
        'total_products' => 'Mostrando :count productos',
    ],

    'allied_list' => [
        'title' => 'Productos Aliados - Arslonga',
        'arslonga_link' => 'Ver más en Arslonga',
        'empty' => 'No hay productos aliados disponibles en este momento.',
        'total_products' => 'Mostrando :count productos',
    ],

    'show' => [
        'title' => 'Detalles del Producto',
        'description' => 'Descripción',
        'price' => 'Precio',
        'stock' => 'Stock',
        'available' => 'Disponible',
        'out_of_stock' => 'Agotado',
        'category' => 'Categoría',
        'add_to_cart' => 'Agregar al Carrito',
        'specs' => 'Especificaciones',
        'no_specs' => 'No hay especificaciones disponibles.',
        'out_of_stock_message' => 'Este producto no está disponible actualmente.',
        'reviews' => 'reseñas',
        'no_image' => 'Sin imagen disponible',
    ],

    'fields' => [
        'name' => 'Nombre',
        'price' => 'Precio',
        'stock' => 'Stock',
        'category' => 'Categoría',
        'specs' => 'Especificaciones',
    ],

    'actions' => [
        'view' => 'Ver',
        'view_details' => 'Ver Detalles',
        'add_to_cart' => 'Agregar al Carrito',
        'buy' => 'Comprar',
        'back' => 'Volver',
        'go_home' => 'Ir al Inicio',
        'more_info' => 'Obtener Descripción con IA',
    ],

    'reviews' => [
        'title' => 'Reseñas',
        'empty' => 'Aún no hay reseñas.',

        'fields' => [
            'rating' => 'Calificación',
            'select_rating' => 'Selecciona una calificación',
            'comment' => 'Comentario',
            'comment_placeholder' => 'Escribe tu reseña aquí...',
            'max_characters' => 'Máximo 1000 caracteres.',
        ],

        'actions' => [
            'submit' => 'Enviar Reseña',
        ],

        'write_review' => 'Escribir una Reseña',
        'login_required' => 'Debes iniciar sesión para dejar una reseña.',
        'login_link' => 'Iniciar sesión',
    ],

    'ranking' => [
        'title_rating' => 'Mejor Valorados',
        'title_sales' => 'Más Vendidos',
        'times_purchased' => 'Veces Comprado',
        'empty' => 'No hay productos disponibles para el ranking.',
        'sales_empty' => 'No hay datos de ventas disponibles.',
    ],
];
