<?php

class Auth
{
    protected $user;

    public function __construct()
    {
        if (Session::user() !== null) {
            $this->user = User::find(Session::user());
        } else {
            $this->user = new User();
        }
        echo "<pre>";
        var_dump($this->user);

        echo "</pre>";
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

        $auth->user->username = $username;

        if ($id = $auth->user->getColumnBy('id', 'username', $username)) {
            if ($auth->user->getColumnBy('password', 'id', $id) === $password) {
                Session::setUser($id);

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
        $auth = new static;
        $auth->user->logout();
        Session::destroy();
    }
}