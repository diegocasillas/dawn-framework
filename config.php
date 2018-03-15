<?php

return [
    'app name' => getenv('APP_NAME'),
    'base' => __DIR__,
    'public' => __DIR__ . '/public',

    'database' => [
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'connection' => getenv('DB_CONNECTION')
    ],

    'routes' => [
        'web' => 'app/routes/routes.php',
        'api' => 'app/routes/routesAPI.php'
    ],

    'service providers' => [
        'router' => '\\Dawn\\Routing\\RoutingServiceProvider',
        'auth' => '\\Dawn\\Auth\\AuthServiceProvider'
    ]
];
