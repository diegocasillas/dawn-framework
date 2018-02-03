<?php

Router::get('miniframework', 'PostController', 'index')->authorization('authenticated');

Router::get('miniframework/login', 'LoginController', 'showLoginForm')->authorization('guests');
Router::post('miniframework/login', 'LoginController', 'login')->authorization('guests');
Router::get('miniframework/logout', 'LoginController', 'logout')->authorization('authenticated');

Router::get('miniframework/register', 'RegisterController', 'showRegistrationForm')->authorization('guests');
Router::post('miniframework/register', 'RegisterController', 'register')->authorization('guests');

Router::get('miniframework/posts', 'PostController', 'index')->authorization('authenticated');
Router::get('miniframework/posts/create', 'PostController', 'create')->authorization('authenticated');
Router::post('miniframework/posts', 'PostController', 'store')->authorization('authenticated');
Router::get('miniframework/posts/(:id)', 'PostController', 'show')->authorization('authenticated');
Router::post('miniframework/posts/(:id)', 'CommentController', 'store')->authorization('authenticated');
Router::get('miniframework/posts/(:id)/edit', 'PostController', 'edit')->authorization('authenticated');
Router::post('miniframework/posts/(:id)/edit', 'PostController', 'update')->authorization('authenticated');
Router::post('miniframework/posts/(:id)/vote', 'PostController', 'vote')->authorization('authenticated');

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
