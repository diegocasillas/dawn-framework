<?php

namespace App\Controllers\Auth;

use Dawn\Auth\Auth;

class RegisterController extends AuthController
{
    public function showRegistrationForm()
    {
        return view('auth/register');
    }

    public function register()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $this->auth->register($username, $password);

        if (auth()->authenticated() && $this->session->getConfig()['mode'] === 'local storage') {
            return $this->tokenResponse()->send();
        }

        redirect();
    }
}
