<?php

$router->get('miniframework', 'PostController', 'index')->authorization('authenticated');

$router->get('miniframework/login', 'LoginController', 'showLoginForm')->authorization('guests');
$router->post('miniframework/login', 'LoginController', 'login')->authorization('guests');
$router->get('miniframework/logout', 'LoginController', 'logout')->authorization('authenticated');

$router->get('miniframework/register', 'RegisterController', 'showRegistrationForm')->authorization('guests');
$router->post('miniframework/register', 'RegisterController', 'register')->authorization('guests');

$router->get('miniframework/posts', 'PostController', 'index')->authorization('authenticated');
$router->get('miniframework/posts/create', 'PostController', 'create')->authorization('authenticated');
$router->post('miniframework/posts', 'PostController', 'store')->authorization('authenticated');
$router->get('miniframework/posts/(:id)', 'PostController', 'show')->authorization('authenticated');
$router->post('miniframework/posts/(:id)', 'CommentController', 'store')->authorization('authenticated');
$router->get('miniframework/posts/(:id)/edit', 'PostController', 'edit')->authorization('authenticated');
$router->post('miniframework/posts/(:id)/edit', 'PostController', 'update')->authorization('authenticated');
$router->post('miniframework/posts/(:id)/vote', 'PostController', 'vote')->authorization('authenticated');

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
