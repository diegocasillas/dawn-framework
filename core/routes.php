<?php

Router::get('miniframework', 'PostController', 'index')->authorization('authenticated');
Router::get('miniframework/404', 'ErrorController', 'error404');
Router::get('miniframework/login', 'LoginController', 'showLoginForm')->authorization('guest');
Router::post('miniframework/login', 'LoginController', 'login')->authorization('guest');
Router::get('miniframework/logout', 'LoginController', 'logout')->authorization('authenticated');

Router::get('miniframework/register', 'RegisterController', 'showRegistrationForm')->authorization('guest');
Router::post('miniframework/register', 'RegisterController', 'register')->authorization('guest');

Router::get('miniframework/posts', 'PostController', 'index')->authorization('authenticated');
Router::get('miniframework/posts/create', 'PostController', 'create')->authorization('authenticated');
Router::post('miniframework/posts', 'PostController', 'store')->authorization('authenticated');

Router::get('miniframework/posts/{id}', 'PostController', 'show')->authorization('authenticated');
Router::post('miniframework/posts/{id}', 'CommentController', 'store')->authorization('authenticated');
Router::post('miniframework/posts/{id}/vote', 'PostController', 'vote')->authorization('authenticated');

Router::get('miniframework/posts/{id}/edit', 'PostController', 'edit')->authorization('owner');
Router::post('miniframework/posts/{id}/edit', 'PostController', 'update')->authorization('owner');

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
