<?php

class LoginController
{
    public static function showLoginForm()
    {
        return view('login/login');
    }

    public static function login()
    {
        Auth::authenticate();

        redirect('');
    }
}