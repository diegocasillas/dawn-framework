<?php

namespace Dawn;

use \Firebase\JWT\JWT;
use Dawn\Routing\Response;

class Session
{
    private $app;
    private $config = 'cookie';
    private $token;
    private $expires;
    private $tokenKey = 'access_token';
    private $tokenResponse;

    public function __construct($app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function start()
    {
        $this->loadToken();
    }

    public function destroy()
    {
        $this->token = null;
        $this->app->deleteCookie($this->tokenKey);
        $this->app->deleteSession($this->tokenKey);
    }

    public function remember()
    {
        $success = false;

        switch ($this->config['mode']) {
            case 'cookie':
                setcookie($this->tokenKey, $this->token, $this->expires, "", "", false, true);
                $success = true;
                break;
            case 'session':
                $_SESSION[$this->tokenKey] = $this->token;
                $success = true;
                break;
            case 'local storage':
                $this->setTokenResponse((new Response([$this->tokenKey => $this->token, 'expires' => $this->getExpires()]))->json());
                $success = true;
                break;
        }

        return $success;
    }

    public function setTokenResponse($response)
    {
        $this->tokenResponse = $response;
    }

    public function getTokenResponse()
    {
        return $this->tokenResponse;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function loadToken()
    {
        switch ($this->config['mode']) {
            case 'cookie':
                $this->token = $this->app->cookie($this->tokenKey);
                break;
            case 'session':
                $this->token = $this->app->session($this->tokenKey);
                break;
            case 'local storage':
                $this->token = $this->app->bearer();
                break;
        }
    }

    public function getConfig()
    {
        return $this->config;
    }
    public function getToken()
    {
        return $this->token;
    }
}