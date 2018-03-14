<?php


namespace App\Controllers;

use Dawn\Routing\Controller;

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

        Auth::login($username, $password);

        redirect();
    }

    public function logout()
    {
        Auth::logout();

        redirect();
    }
}