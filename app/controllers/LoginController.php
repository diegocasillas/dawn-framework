<?php

class LoginController
{
    public static function showLoginForm()
    {
        return view('login/login');
    }

    public static function login()
    {
        Auth::attempt($_REQUEST['username'], $_REQUEST['password']);

        redirect();
    }

    public static function logout()
    {
        Auth::logout();

        redirect();
    }
}