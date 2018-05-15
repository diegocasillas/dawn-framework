<?php

namespace Dawn\Session;

use Dawn\Routing\Response;

/**
 * Creates and destroys the session.
 */
class Session
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    private $app;

    /**
     * The configuration array.
     *
     * @var array
     */
    private $config = [];

    /**
     * The current session mode.
     *
     * @var string
     */
    private $mode = 'cookie';

    /**
     * The current JWT token.
     *
     * @var string
     */
    private $token;

    /**
     * The token expiry time in seconds.
     *
     * @var integer
     */
    private $expires;

    /**
     * The token key for the session.
     *
     * @var string
     */
    private $tokenKey = 'access_token';

    /**
     * A prepared token response in JSON.
     *
     * @var Dawn\Routing\Response
     */
    private $tokenResponse;

    /**
     * Create a new Session instance.
     *
     * @param Dawn\App\App $app
     * @param array $config
     */
    public function __construct($app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    /**
     * Starts the session.
     *
     * @return void
     */
    public function start()
    {
        $this->loadToken();
    }

    /**
     * Destroys the session.
     *
     * @return void
     */
    public function destroy()
    {
        $this->token = null;
        $this->deleteCookie($this->tokenKey);
        $this->deleteSession($this->tokenKey);
    }

    /**
     * Remember the token.
     *
     * @return boolean
     */
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

    /**
     * Load the token from the request.
     *
     * @return void
     */
    public function loadToken()
    {
        switch ($this->config['mode']) {
            case 'cookie':
                $this->token = $this->cookie($this->tokenKey);
                break;
            case 'session':
                session_start();
                $this->token = $this->session($this->tokenKey);
                break;
            case 'local storage':
                $this->token = $this->bearer();
                break;
        }
    }

    /**
     * Return the token from a cookie.
     *
     * @return mixed
     */
    public function cookie()
    {
        if (array_key_exists($this->tokenKey, $_COOKIE)) {
            return $_COOKIE[$this->tokenKey];
        }

        return null;
    }

    /**
     * Delete the token cookie.
     *
     * @return void
     */
    public function deleteCookie()
    {
        if (array_key_exists($this->tokenKey, $_COOKIE)) {
            setcookie($this->tokenKey, "");
            unset($_COOKIE[$this->tokenKey]);
        }
    }

    /**
     * Return the token from the session.
     *
     * @return mixed
     */
    public function session()
    {
        if (array_key_exists($this->tokenKey, $_SESSION)) {
            return $_SESSION[$this->tokenKey];
        }

        return null;
    }

    /**
     * Delete the session.
     *
     * @return void
     */
    public function deleteSession()
    {
        session_destroy();
    }

    /**
     * Return the token from the Authorization header.
     *
     * @return mixed
     */
    public function bearer()
    {
        if (array_key_exists('Authorization', getallheaders())) {
            return substr(getallheaders()['Authorization'], strlen('Bearer '));
        }

        return null;
    }

    /**
     * Get the app instance.
     *
     * @return Dawn\App\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set the app instance-
     *
     * @param Dawn\App\App $app
     * @return void
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * Get the config array.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config array.
     *
     * @param array $config
     * @return void
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * Get the mode setting.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode = $mode;
    }

    /**
     * Set the mode setting.
     *
     * @param string $mode
     * @return void
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get the JWT token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the JWT token.
     *
     * @param string $token
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get the expiry time.
     *
     * @return int
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set the expiry time.
     *
     * @param integer $expires
     * @return void
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    /**
     * Get the token key.
     *
     * @return string
     */
    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * Set the token key-
     *
     * @param string $tokenKey
     * @return void
     */
    public function setTokenKey($tokenKey)
    {
        $this->tokenKey = $tokenKey;
    }

    /**
     * Get the token response instance.
     *
     * @return Dawn\Routing\Response
     */
    public function getTokenResponse()
    {
        return $this->tokenResponse;
    }

    /**
     * Set the token response instance.
     *
     * @param Dawn\Routing\Response $response
     * @return void
     */
    public function setTokenResponse($response)
    {
        $this->tokenResponse = $response;
    }
}
