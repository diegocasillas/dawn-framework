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

    public static function login($username, $password)
    {
        $auth = new static;


        if ($id = $auth->user->getColumnBy('id', 'username', $username)) {
            if ($auth->user->getColumnBy('password', 'id', $id) === $password) {
                Auth::authenticate();
            }
        }

        return redirect();
    }

    public static function register($username, $password)
    {
        $auth = new static;

        $auth->user->setUsername($username);
        $auth->user->setPassword($password);

        // check if user already exists
        if (!$auth->user->getBy('username', $auth->user->username())) {
            $auth->user->create();
            Auth::authenticate();
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