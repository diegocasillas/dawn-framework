<?php

$this->get('miniframework/apitest', 'PostController', 'api');

// Login, logout and register
$this->get('miniframework/login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
$this->post('miniframework/login', 'Auth\LoginController', 'login')->auth('guest');
$this->get('miniframework/logout', 'Auth\LoginController', 'logout')->auth('authenticated');
$this->get('miniframework/register', 'Auth\RegisterController', 'showRegistrationForm')->auth('guest');
$this->post('miniframework/register', 'Auth\RegisterController', 'register')->auth('guest');

// Users
$this->get('miniframework/users/{id}', 'UserController', 'show')->auth('authenticated');
$this->get('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');
$this->post('miniframework/users/{id}/edit', 'UserController', 'edit')->auth('owner');

// Posts
$this->get('miniframework', 'PostController', 'index')->auth('authenticated');
$this->get('miniframework/posts', 'PostController', 'index')->auth('authenticated');
$this->get('miniframework/api', 'PostController', 'apiIndex')->auth('authenticated');
$this->get('miniframework/posts/create', 'PostController', 'create')->auth('authenticated');
$this->post('miniframework/posts/create', 'PostController', 'store')->auth('authenticated');
$this->get('miniframework/posts/{id}', 'PostController', 'show')->auth('authenticated');
$this->get('miniframework/posts/{id}/edit', 'PostController', 'edit')->auth('owner');
$this->post('miniframework/posts/{id}/edit', 'PostController', 'update')->auth('owner');

// Comments
$this->post('miniframework/posts/{id}', 'CommentController', 'store')->auth('authenticated');
$this->post('miniframework/posts/{id}/vote', 'PostController', 'vote')->auth('authenticated');

// Errors
$this->get('miniframework/404', 'ErrorController', 'notFound');
$this->get('miniframework/401', 'ErrorController', 'unauthorized');