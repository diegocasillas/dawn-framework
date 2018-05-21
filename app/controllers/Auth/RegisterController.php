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
        $email = $this->input('email');
        $username = $this->input('username');
        $password = $this->input('password');

        $this->auth->register($email, $username, $password);

        if (auth()->authenticated() && $this->session->getConfig()['mode'] === 'local storage') {
            return $this->tokenResponse()->send();
        }

        redirect();
    }
}
