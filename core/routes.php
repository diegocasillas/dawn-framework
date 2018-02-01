<?php

$router->get('miniframework', 'PostController', 'index')->protected();
$router->get('miniframework/login', 'LoginController', 'showLoginForm');
$router->post('miniframework/login', 'LoginController', 'login');
$router->get('miniframework/posts', 'PostController', 'index');
$router->get('miniframework/posts/create', 'PostController', 'create');
$router->post('miniframework/posts', 'PostController', 'store');
$router->get('miniframework/posts/(:id)', 'PostController', 'show');
$router->post('miniframework/posts/(:id)', 'CommentController', 'store');
$router->get('miniframework/posts/(:id)/edit', 'PostController', 'edit');
$router->post('miniframework/posts/(:id)/edit', 'PostController', 'update');
$router->post('miniframework/posts/(:id)/vote', 'PostController', 'vote');

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
