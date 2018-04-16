<?php

return [
    'app name' => getenv('APP_NAME'),
    'base' => __DIR__,
    'public' => __DIR__ . '/public',
    'key' => base64_encode(getenv('KEY')),

    'database' => [
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'connection' => getenv('DB_CONNECTION')
    ],

    'routes' => [
        'web' => 'app/routes/routes.php',
        'api' => 'app/routes/routesAPI.php',
        'admin' => 'Dawn/Admin/routesAdmin.php'
    ],

    'service providers' => [
        'database' => '\\Dawn\\Database\\DatabaseServiceProvider',
        'router' => '\\Dawn\\Routing\\RoutingServiceProvider',
        'session' => '\\Dawn\\SessionServiceProvider',
        'auth' => '\\Dawn\\Auth\\AuthServiceProvider'
    ]
];
