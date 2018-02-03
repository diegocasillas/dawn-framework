<?php

class LoginController
{
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        Auth::login($username, $password);

        redirect();
    }

    public function logout()
    {
        Auth::logout();

        redirect();
    }
}