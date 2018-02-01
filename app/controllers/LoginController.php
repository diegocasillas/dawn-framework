<?php

class LoginController
{
    public static function showLoginForm()
    {
        return view('auth/login');
    }

    public static function login()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        Auth::login($username, $password);

        redirect();
    }

    public static function logout()
    {
        Auth::logout();

        redirect();
    }
}