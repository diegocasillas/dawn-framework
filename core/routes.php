<?php

$router->get(new Route('miniframework', 'PostController', 'index'));
$router->get(new Route('miniframework/posts/create', 'PostController', 'create'));
$router->post(new Route('miniframework/posts', 'PostController', 'store'));
$router->get(new Route('miniframework/posts/(:id)', 'PostController', 'show'));
$router->get(new Route('miniframework/posts/(:id)/edit', 'PostController', 'edit'));

// return $routes = [
//     '' => [
//         'controller' => 'PostController',
//         'action' => 'index'
//     ],
//     'posts' => [
//         'controller' => 'PostController',
//         'action' => 'lmao'
//     ],
//     'posts/create' => [
//         'controller' => 'PostController',
//         'action' => 'store'
//     ]
// ];
