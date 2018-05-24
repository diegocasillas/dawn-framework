<?php

// Login, logout and register
$this->get('login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
$this->post('login', 'Auth\LoginController', 'login')->auth('guest');
$this->get('logout', 'Auth\LoginController', 'logout')->auth('authenticated');
$this->get('register', 'Auth\RegisterController', 'showRegistrationForm')->auth('guest');
$this->post('register', 'Auth\RegisterController', 'register')->auth('guest');

// Errors
$this->get('404', 'ErrorController', 'notFound');
$this->get('401', 'ErrorController', 'unauthorized');

// App

$this->get('', 'HomeController', 'home')->auth('authenticated');
