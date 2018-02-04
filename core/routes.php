<?php

// Login, logout and register
Router::get('miniframework/login', 'LoginController', 'showLoginForm')->auth('guest');
Router::post('miniframework/login', 'LoginController', 'login')->auth('guest');
Router::get('miniframework/logout', 'LoginController', 'logout')->auth('authenticated');
Router::get('miniframework/register', 'RegisterController', 'showRegistrationForm')->auth('guest');
Router::post('miniframework/register', 'RegisterController', 'register')->auth('guest');

// Users
Router::get('miniframework/users/{id}', 'UserController', 'show')->auth('authenticated');
Router::get('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');
Router::post('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');

// Posts
Router::get('miniframework', 'PostController', 'index')->auth('authenticated');
Router::get('miniframework/posts', 'PostController', 'index')->auth('authenticated');
Router::get('miniframework/api', 'PostController', 'apiIndex')->auth('authenticated');
Router::get('miniframework/posts/create', 'PostController', 'create')->auth('authenticated');
Router::post('miniframework/posts/create', 'PostController', 'store')->auth('authenticated');
Router::get('miniframework/posts/{id}', 'PostController', 'show')->auth('authenticated');
Router::get('miniframework/posts/{id}/edit', 'PostController', 'edit')->auth('owner');
Router::post('miniframework/posts/{id}/edit', 'PostController', 'update')->auth('owner');

// Comments
Router::post('miniframework/posts/{id}', 'CommentController', 'store')->auth('authenticated');
Router::post('miniframework/posts/{id}/vote', 'PostController', 'vote')->auth('authenticated');

// Errors
Router::get('miniframework/404', 'ErrorController', 'notFound');
Router::get('miniframework/401', 'ErrorController', 'unauthorized');