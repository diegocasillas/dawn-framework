<?php

$this->get('apitest', 'PostController', 'api');

// Login, logout and register
$this->get('login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
$this->post('login', 'Auth\LoginController', 'login')->auth('guest');
$this->get('logout', 'Auth\LoginController', 'logout')->auth('authenticated');
$this->get('register', 'Auth\RegisterController', 'showRegistrationForm')->auth('guest');
$this->post('register', 'Auth\RegisterController', 'register')->auth('guest');

// Users
$this->get('users/{id}', 'UserController', 'show')->auth('authenticated');
$this->get('users/{id}/edit', 'UserController', 'edit')->auth('owner');
$this->post('users/{id}/edit', 'UserController', 'edit')->auth('owner');

// Posts
$this->get('', 'PostController', 'index')->auth('authenticated');
$this->get('posts', 'PostController', 'index')->auth('authenticated');
$this->get('api', 'PostController', 'apiIndex')->auth('authenticated');
$this->get('posts/create', 'PostController', 'create')->auth('authenticated');
$this->post('posts/create', 'PostController', 'store')->auth('authenticated');
$this->get('posts/{id}', 'PostController', 'show')->auth('authenticated');
$this->get('posts/{id}/edit', 'PostController', 'edit')->auth('owner');
$this->post('posts/{id}/edit', 'PostController', 'update')->auth('owner');

// Comments
$this->post('posts/{id}', 'CommentController', 'store')->auth('authenticated');
$this->post('posts/{id}/vote', 'PostController', 'vote')->auth('authenticated');

// Errors
$this->get('404', 'ErrorController', 'notFound');
$this->get('401', 'ErrorController', 'unauthorized');
