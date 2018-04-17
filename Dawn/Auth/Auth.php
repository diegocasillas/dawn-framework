<?php

namespace Dawn\Auth;

use Dawn\Session;
use App\Models\User;
use Firebase\JWT\JWT;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Util\Json;
use Firebase\JWT\ExpiredException;

class Auth
{
    protected $app;
    protected $token;
    protected $user;
    protected $id;

    public function __construct($app)
    {
        $this->app = $app;
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
        $this->app->get('session')->setUser($id);
    }

    protected function generateToken(array $tokenData = [])
    {
        return JWT::encode($tokenData, $this->app->getKey());
    }

    protected function decodeToken(string $token)
    {
        try {
            $decodedToken = JWT::decode($token, app()->getKey(), array('HS256'));
        } catch (ExpiredException $e) {
            $decodedToken = null;
        }

        return $decodedToken;
    }

    public function logout()
    {
        $this->app->get('session')->destroy();
    }

    public function login($username, $password)
    {
        $this->user = new User();

        $this->user->setUsername($username);
        $this->user->setPassword($password);

        if ($id = $this->user->getColumnBy('id', 'username', $this->user->username())) {
            if (password_verify($this->user->password(), $this->user->getColumnBy('password', 'id', $id, true))) {
                $this->authenticate($this->generateToken(['iss' => $_SERVER['SERVER_NAME'], 'iat' => time(), 'exp' => time() + app()->get('session')->getConfig()['expires'], 'id' => $id]));
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

    public function findUser()
    {
        if ($this->token === null) {
            $this->user = null;
        } else {
            if ($this->decodeToken($this->token) !== null) {
                $this->user = (new User())->find($this->decodeToken($this->token)->id);
                $this->id = $this->user->id();
            } else {
                $this->user = null;
            }
        }
    }

    public function setToken($token)
    {
        $this->token = $token;
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