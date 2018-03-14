<?php

namespace Dawn\Auth;

use Dawn\Session;
use App\Models\User;

class Auth
{
    protected $user;
    protected $id;

    public function __construct()
    {
        if (Session::user() === null) {
            $this->user = null;
        } else {
            $this->user = User::find(Session::user());
            $this->id = $this->user->id();
        }
    }

    public static function check($options, ...$parameters)
    {
        $auth = new static;

        foreach ($options as $option) {
            if (!$auth->$option(...$parameters)) {
                return false;
            }
        }

        return true;
    }

    public static function authenticated()
    {
        $auth = new static;

        if ($auth->user === null) {
            return false;
        }

        return true;
    }

    public static function guest()
    {
        $auth = new static;

        if ($auth->user !== null) {
            return false;
        }

        return true;
    }

    public static function owner($ownerId)
    {
        $auth = new static;

        if ($auth->id !== $ownerId) {
            return false;
        }

        return true;
    }

    public function isOwner($element)
    {
        $auth = new static;

        return $auth->id === $element->userId();
    }

    protected function authenticate($id)
    {
        Session::setUser($id);
    }

    public static function logout()
    {
        Session::destroy();
    }

    public static function login($username, $password)
    {
        $auth = new static;

        $auth->user = new User();

        $auth->user->setUsername($username);
        $auth->user->setPassword($password);

        if ($id = $auth->user->getColumnBy('id', 'username', $auth->user->username())) {
            if ($auth->user->getColumnBy('password', 'id', $id) === $auth->user->password()) {
                $auth->authenticate($id);
            }
        }

        return redirect();
    }

    public static function register($username, $password)
    {
        $auth = new static;
        $auth->user = new User();

        $auth->user->setUsername($username);
        $auth->user->setPassword($password);

        // check if user already exists
        if (!$auth->user->getBy('username', $auth->user->username())) {
            $auth->user->create();
            $auth->authenticate($auth->user->id());
        }

        return redirect();
    }

    public static function user()
    {
        $auth = new static;

        return $auth->user;
    }

    public static function id()
    {
        $auth = new static;

        return $auth->id;
    }
}