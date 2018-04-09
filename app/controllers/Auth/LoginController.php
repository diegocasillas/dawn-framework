<?php


namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Dawn\Auth\Auth;

class LoginController extends Controller
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

        redirect();
    }

    public function logout()
    {
        Auth::logout();

        redirect();
    }
}