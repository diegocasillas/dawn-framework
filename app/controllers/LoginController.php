<?php

class LoginController
{
    public static function showLoginForm()
    {
        return view('auth/login');
    }

    public static function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        Auth::login($username, $password);

        redirect();
    }

    public static function logout()
    {
        Auth::logout();

        redirect();
    }
}