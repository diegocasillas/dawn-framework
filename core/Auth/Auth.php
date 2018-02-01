<?php

class Auth
{
    protected $user;

    public function __construct()
    {
        $this->user = Session::user();
    }

    public static function user()
    {
        $auth = new static;

        return $auth->user;
    }

    public static function check()
    {
        $auth = new static;

        return $auth->user->isAuthenticated();
    }

    public static function attempt($username, $password)
    {
        $auth = new static;

        if ($id = $auth->user->getColumnBy('id', 'username', $username)) {
            if ($auth->user->getColumnBy('password', 'id', $id) === $password) {
                Auth::authenticate();
            }
        }

        return redirect();
    }

    public static function authenticate()
    {
        $auth = new static;

        $auth->user->authenticate();
    }

    public static function logout()
    {
        Session::destroy();
    }
}