<?php

return [
    'user' => [
        'add_default_role_on_register' => false,
        'default_role'                 => 'volunteer',
        'admin_permission'             => 'browse_admin',
        'namespace'                    => App\Models\User::class,
    ],

    'controllers' => [
        'namespace' => 'App\\Http\\Controllers\\Voyager',
    ]
];