<?php

// Login, logout and register
$router->get('miniframework/login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
$router->post('miniframework/login', 'Auth\LoginController', 'login')->auth('guest');
$router->get('miniframework/logout', 'Auth\LoginController', 'logout')->auth('authenticated');
$router->get('miniframework/register', 'Auth\RegisterController', 'showRegistrationForm')->auth('guest');
$router->post('miniframework/register', 'Auth\RegisterController', 'register')->auth('guest');

// Users
$router->get('miniframework/users/{id}', 'UserController', 'show')->auth('authenticated');
$router->get('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');
$router->post('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');

// Posts
$router->get('miniframework', 'PostController', 'index')->auth('authenticated');
$router->get('miniframework/posts', 'PostController', 'index')->auth('authenticated');
$router->get('miniframework/api', 'PostController', 'apiIndex')->auth('authenticated');
$router->get('miniframework/posts/create', 'PostController', 'create')->auth('authenticated');
$router->post('miniframework/posts/create', 'PostController', 'store')->auth('authenticated');
$router->get('miniframework/posts/{id}', 'PostController', 'show')->auth('authenticated');
$router->get('miniframework/posts/{id}/edit', 'PostController', 'edit')->auth('owner');
$router->post('miniframework/posts/{id}/edit', 'PostController', 'update')->auth('owner');

// Comments
$router->post('miniframework/posts/{id}', 'CommentController', 'store')->auth('authenticated');
$router->post('miniframework/posts/{id}/vote', 'PostController', 'vote')->auth('authenticated');

// Errors
$router->get('miniframework/404', 'ErrorController', 'notFound');
$router->get('miniframework/401', 'ErrorController', 'unauthorized');