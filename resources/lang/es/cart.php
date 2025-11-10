<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    'title' => 'Tu carrito',
    'empty' => 'Tu carrito está vacío.',

    'table' => [
        'product' => 'Producto',
        'price' => 'Precio',
        'quantity' => 'Cantidad',
        'subtotal' => 'Subtotal',
        'actions' => 'Acciones',
        'remove_item' => 'Eliminar',
    ],

    'summary' => 'Resumen del pedido',
    'clear_cart' => 'Eliminar todo',
    'total' => 'Total',
    'total_items' => 'Total de artículos',
    'checkout' => 'Proceder al pago',
    'continue_shopping' => 'Seguir comprando',
    'tips' => 'Pago seguro con encriptación',

    'modals' => [
        'remove_item' => [
            'title' => 'Eliminar Producto',
            'message' => '¿Estás seguro de que quieres eliminar ":product" de tu carrito?',
        ],
        'clear_cart' => [
            'title' => 'Vaciar Carrito',
            'message' => '¿Estás seguro de que quieres eliminar todos los productos de tu carrito? Esta acción no se puede deshacer.',
        ],
        'confirm' => 'Confirmar',
        'cancel' => 'Cancelar',
    ],

    'success' => [
        'added' => 'Producto agregado al carrito exitosamente.',
        'removed' => 'Producto eliminado del carrito exitosamente.',
        'removed_all' => 'Todos los productos eliminados del carrito exitosamente.',
    ],

    'errors' => [
        'not_found' => 'Producto no encontrado en el carrito.',
    ],

];
