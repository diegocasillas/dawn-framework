<?php

namespace Dawn\Auth;

use Dawn\Session;
use App\Models\User;
use Firebase\JWT\JWT;

class Auth
{
    protected $app;
    protected $user;
    protected $id;

    public function __construct($app = null)
    {
        $this->app = $app;

        if (Session::user() === null) {
            $this->user = null;
        } else {
            $this->user = (new User())->find(Session::user());
            $this->id = $this->user->id();
        }
    }

    public function check($options, ...$parameters)
    {
        foreach ($options as $option) {
            if (!$this->$option(...$parameters)) {
                return false;
            }
        }

        return true;
    }

    public function authenticated()
    {
        if ($this->user === null) {
            return false;
        }

        return true;
    }

    public function guest()
    {
        if ($this->user !== null) {
            return false;
        }

        return true;
    }

    public function owner($ownerId)
    {
        if ($this->id !== $ownerId) {
            return false;
        }

        return true;
    }

    public function isOwner($element)
    {
        return $this->id === $element->userId();
    }

    protected function authenticate($id)
    {
        Session::setUser($this->generateJWT($id));
    }

    protected function generateJWT($id)
    {
        $secret = $this->app->getKey();
        $token = array(
            "id" => $id
        );

        $jwt = JWT::encode($token, $secret);

        return $jwt;
    }

    public function logout()
    {
        Session::destroy();
    }

    public function login($username, $password)
    {
        $this->user = new User();

        $this->user->setUsername($username);
        $this->user->setPassword($password);

        if ($id = $this->user->getColumnBy('id', 'username', $this->user->username())) {
            if (password_verify($this->user->password(), $this->user->getColumnBy('password', 'id', $id, true))) {
                $this->authenticate($id);
            }
        }

        return redirect();
    }

    public function register($username, $password)
    {
        $this->user = new User();

        $this->user->setUsername($username);
        $this->user->setPassword(password_hash($password, PASSWORD_BCRYPT));

        // check if user already exists
        if (!$this->user->getBy('username', $this->user->username())) {
            $this->user->create();
            $this->authenticate($this->user->id());
        } else {
            die("user exists");
        }

        return redirect();
    }

    public function user()
    {
        return $this->user;
    }

    public function id()
    {
        return $this->id;
    }
}