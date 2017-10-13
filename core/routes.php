<?php

$router->get('miniframework', 'PostController', 'index');
$router->get('miniframework/posts/create', 'PostController', 'create');
$router->post('miniframework/posts', 'PostController', 'store');

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
