<?php

namespace Dawn;

use \Firebase\JWT\JWT;

class Session
{
    public $app;
    public $token;
    public $tokenKey = 'access_token';

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function start()
    {
        $this->loadToken();
    }

    public function destroy()
    {
        $this->token = null;
        $this->app->deleteCookie($this->tokenKey);
    }

    public function setUser($userId)
    {
        header("Set-Cookie: $this->tokenKey=$userId; httpOnly");
    }

    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    public function loadToken()
    {
        $this->token = $this->app->cookie($this->tokenKey);
    }

    public function token()
    {
        return $this->token;
    }
}