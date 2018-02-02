<?php

$router->get('miniframework', 'PostController', 'index')->protected();
$router->get('miniframework/login', 'LoginController', 'showLoginForm')->isForGuests();
$router->post('miniframework/login', 'LoginController', 'login')->isForGuests();
$router->get('miniframework/register', 'RegisterController', 'showRegistrationForm');
$router->post('miniframework/register', 'RegisterController', 'register');
$router->get('miniframework/logout', 'LoginController', 'logout')->protected();
$router->get('miniframework/posts', 'PostController', 'index')->protected();
$router->get('miniframework/posts/create', 'PostController', 'create')->protected();
$router->post('miniframework/posts', 'PostController', 'store')->protected();
$router->get('miniframework/posts/(:id)', 'PostController', 'show')->protected();
$router->post('miniframework/posts/(:id)', 'CommentController', 'store')->protected();
$router->get('miniframework/posts/(:id)/edit', 'PostController', 'edit')->protected();
$router->post('miniframework/posts/(:id)/edit', 'PostController', 'update')->protected();
$router->post('miniframework/posts/(:id)/vote', 'PostController', 'vote')->protected();

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
