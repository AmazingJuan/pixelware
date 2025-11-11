<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title' => 'Panel de Administración',
        'welcome' => 'Bienvenido al panel de administración. Aquí puedes gestionar los recursos principales de la aplicación.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Usuarios
    |--------------------------------------------------------------------------
    */
    'users' => [
        'title' => 'Gestión de Usuarios',
        'description' => 'Crear, editar y eliminar usuarios.',

        'attributes' => [
            'id' => 'ID',
            'username' => 'Nombre de Usuario',
            'email' => 'Correo Electrónico',
            'address' => 'Dirección',
            'balance' => 'Saldo',
            'role' => 'Rol',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmar Contraseña',
        ],

        'roles' => [
            'admin' => 'Administrador',
            'customer' => 'Cliente',
        ],

        'sections' => [
            'create' => 'Crear un usuario',
            'edit' => 'Editar un usuario',
        ],

        'confirmations' => [
            'delete' => [
                'title' => 'Confirmar Eliminación',
                'message' => '¿Seguro que quieres eliminar este usuario? Esta acción no se puede deshacer.',
            ],
        ],

        'reminders' => [
            'keep_blank' => 'Dejar en blanco para mantener el valor actual',
        ],

        'empty' => 'No hay usuarios para gestionar.',
        'success' => [
            'created' => 'Usuario creado correctamente.',
            'updated' => 'Usuario actualizado correctamente.',
            'deleted' => 'Usuario eliminado correctamente.',
        ],
        'errors' => [
            'not_found' => 'Usuario no encontrado.',
            'delete_failed' => 'No se pudo eliminar el usuario.',
            'create_failed' => 'No se pudo crear el usuario.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Productos
    |--------------------------------------------------------------------------
    */
    'products' => [
        'title' => 'Gestión de Productos',
        'description' => 'Crear, editar y eliminar productos.',

        'attributes' => [
            'id' => 'ID',
            'name' => 'Nombre',
            'price' => 'Precio',
            'description' => 'Descripción',
            'stock' => 'Stock',
            'category' => 'Categoría',
            'specs' => 'Especificaciones',
            'image' => 'Imagen del Producto',
            'image_hint' => 'Sube una imagen del producto (JPEG, PNG).',
            'storage_driver' => 'Almacenamiento',
        ],

        'placeholders' => [
            'spec_key' => 'GPU',
            'spec_value' => 'NVIDIA RTX 3080',
            'storage_driver' => 'Selecciona un almacenamiento',
        ],

        'storage_drivers' => [
            'local' => 'Local',
            'gcs' => 'Google Cloud Storage',
        ],

        'sections' => [
            'create' => 'Crear un producto',
            'edit' => 'Editar un producto',
        ],

        'actions' => [
            'add_spec' => 'Agregar Especificación',
        ],

        'empty' => 'No hay productos para gestionar.',
        'out_of_stock' => 'Agotado',
        'success' => [
            'created' => 'Producto creado correctamente.',
            'updated' => 'Producto actualizado correctamente.',
            'deleted' => 'Producto eliminado correctamente.',
        ],
        'errors' => [
            'not_found' => 'Producto no encontrado.',
            'delete_failed' => 'No se pudo eliminar el producto.',
            'create_failed' => 'No se pudo crear el producto.',
        ],
        'confirmations' => [
            'delete' => [
                'title' => 'Confirmar Eliminación',
                'message' => '¿Seguro que quieres eliminar este producto? Esta acción no se puede deshacer.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Común
    |--------------------------------------------------------------------------
    */
    'common' => [
        'save' => 'Guardar',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'cancel' => 'Cancelar',
        'confirm' => 'Confirmar',
        'actions_title' => 'Acciones',
        'back' => 'Volver',
        'update' => 'Actualizar',
        'create' => 'Crear',
    ],

];
