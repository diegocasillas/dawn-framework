<?php

return [
    'app name' => getenv('APP_NAME'),
    'base' => __DIR__,
    'public' => __DIR__ . '/public',
    'key' => base64_encode(getenv('KEY')),

    /**
     * Values:
     *      mode => 'cookie', 'session', 'local storage'
     *      expires => time in seconds, example: 3600
     */
    'session' => [
        'mode' => 'cookie',
        'expires' => 864000
    ],

    'database' => [
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'connection' => getenv('DB_CONNECTION')
    ],

    'routes' => [
        'web' => 'app/routes/web.php',
        'api' => 'app/routes/api.php',
        'admin' => 'Dawn/Admin/routes.php'
    ],

    'service providers' => [
        'database' => '\\Dawn\\Database\\DatabaseServiceProvider',
        'router' => '\\Dawn\\Routing\\RoutingServiceProvider',
        'session' => '\\Dawn\\Session\\SessionServiceProvider',
        'auth' => '\\Dawn\\Auth\\AuthServiceProvider'
    ]
];
