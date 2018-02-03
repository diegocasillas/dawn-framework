<?php

class Auth
{
    protected $user;
    protected $owner = false;

    public function __construct()
    {
        if (Session::user() === null) {
            $this->user = null;
        } else {
            $this->user = User::find(Session::user());
        }
    }

    public static function user()
    {
        $auth = new static;

        return $auth->user;
    }

    public static function id()
    {
        $auth = new static;

        return $auth->user->id();
    }

    public static function check($authorization = [], $model = null, $parameters = null)
    {
        $auth = new static;

        foreach ($authorization as $type) {
            $authorized = $auth->$type($model, $parameters);

            if (!$authorized) {
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

    public function owner($model, $id)
    {
        if ($this->user->id() !== $model::find($id)->userId()) {
            return false;
        }

        $this->owner = true;
        return true;
    }

    public function isOwner($element)
    {
        return Auth::id() === $element->userId();
    }

    protected function authenticate($id)
    {
        Session::setUser($id);
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

    public static function logout()
    {
        Session::destroy();
    }
}