<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Dawn\Auth\Auth;

class RegisterController extends Controller
{
    public static function showRegistrationForm()
    {
        return view('auth/register');
    }

    public static function register()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        auth()->register($username, $password);

        redirect();
    }
}