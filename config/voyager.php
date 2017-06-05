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
    ],

    'models' => [
        'namespace' => 'App\\Models\\',
    ],

    'multilingual' => [
        /*
         * Set whether or not the multilingual is supported by the BREAD input.
         */
        'enabled' => true,

        /*
         * Select default language
         */
        'default' => 'nl',

        /*
         * Select languages that are supported.
         */
        'locales' => [
            'en',
            'nl',
        ],
    ],

    'widgets' => [
        [
            'name'  => 'User',
            'icon'  => 'voyager-group',
            'model' => TCG\Voyager\Models\User::class,
            'url'   => 'admin/users',
            'image' => '/images/widget-backgrounds/02.png',
        ],
        [
            'name'  => 'Post',
            'icon'  => 'voyager-news',
            'model' => TCG\Voyager\Models\Post::class,
            'url'   => 'admin/posts',
            'image' => '/images/widget-backgrounds/03.png',
        ],
        [
            'name'  => 'Page',
            'icon'  => 'voyager-file-text',
            'model' => TCG\Voyager\Models\Page::class,
            'url'   => 'admin/pages',
            'image' => '/images/widget-backgrounds/04.png',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard config
    |--------------------------------------------------------------------------
    |
    | Here you can modify some aspects of your dashboard
    |
    */

    'dashboard' => [
        // Add custom list items to navbar's dropdown
        'navbar_items' => [
            'Profile' => [
                'route'         => 'voyager.profile',
                'classes'       => 'class-full-of-rum',
                'icon_class'    => 'voyager-person',
            ],
            'Home' => [
                'route'         => '/',
                'icon_class'    => 'voyager-home',
                'target_blank'  => true,
            ],
            'Logout' => [
                'route'      => 'voyager.logout',
                'icon_class' => 'voyager-power',
            ],
        ],

        'data_tables' => [
            'responsive' => true, // Use responsive extension for jQuery dataTables that are not server-side paginated
        ],

        'widgets' => [
            'TCG\\Voyager\\Widgets\\UserDimmer',
            'TCG\\Voyager\\Widgets\\PostDimmer',
            'TCG\\Voyager\\Widgets\\PageDimmer',
        ],

    ],
];