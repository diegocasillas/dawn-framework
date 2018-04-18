<?php

namespace App\Controllers\Auth;

use Dawn\Auth\Auth;
use Dawn\Auth\AuthController;

class LoginController extends AuthController
{
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        auth()->login($username, $password);

        if (auth()->authenticated() && $this->session->getConfig()['mode'] === 'local storage') {
            return $this->tokenResponse()->send();
        }

        redirect();
    }

    public function logout()
    {
        auth()->logout();

        redirect();
    }
}