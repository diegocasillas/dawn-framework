<?php

class Auth
{
    public static function user()
    {
        return $_SESSION['USER'];
    }

    public static function check()
    {
        return $_SESSION['USER']->isAuthenticated();
    }

    public static function authenticate()
    {
        $_SESSION['USER']->authenticate();
    }
}