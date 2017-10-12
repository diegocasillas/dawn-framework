<?php

$router->get('miniframework', 'PostController', 'index');
$router->get('miniframework/posts/create', 'PostController', 'store');
$router->get('miniframework/posts', 'PostController', 'show');

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
