<?php

$this->get('dawn/apitest', 'PostController', 'api');

// Login, logout and register
$this->get('dawn/login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
$this->post('dawn/login', 'Auth\LoginController', 'login')->auth('guest');
$this->get('dawn/logout', 'Auth\LoginController', 'logout')->auth('authenticated');
$this->get('dawn/register', 'Auth\RegisterController', 'showRegistrationForm')->auth('guest');
$this->post('dawn/register', 'Auth\RegisterController', 'register')->auth('guest');

// Users
$this->get('dawn/users/{id}', 'UserController', 'show')->auth('authenticated');
$this->get('dawn/users/{id}/edit', 'UserController', 'edit')->auth('owner');
$this->post('dawn/users/{id}/edit', 'UserController', 'edit')->auth('owner');

// Posts
$this->get('dawn', 'PostController', 'index')->auth('authenticated');
$this->get('dawn/posts', 'PostController', 'index')->auth('authenticated');
$this->get('dawn/api', 'PostController', 'apiIndex')->auth('authenticated');
$this->get('dawn/posts/create', 'PostController', 'create')->auth('authenticated');
$this->post('dawn/posts/create', 'PostController', 'store')->auth('authenticated');
$this->get('dawn/posts/{id}', 'PostController', 'show')->auth('authenticated');
$this->get('dawn/posts/{id}/edit', 'PostController', 'edit')->auth('owner');
$this->post('dawn/posts/{id}/edit', 'PostController', 'update')->auth('owner');

// Comments
$this->post('dawn/posts/{id}', 'CommentController', 'store')->auth('authenticated');
$this->post('dawn/posts/{id}/vote', 'PostController', 'vote')->auth('authenticated');

// Errors
$this->get('dawn/404', 'ErrorController', 'notFound');
$this->get('dawn/401', 'ErrorController', 'unauthorized');
