<?php

namespace Dawn\Routing;

class Request
{
    protected $uri;
    protected $method;
    protected $endpoint;
    protected $requestedRoute;
    protected $input = [];
    protected $ip;
    protected $userAgent;

    public function get()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $this->method = $_SERVER['REQUEST_METHOD'];

        if (preg_match('#/api/#', $this->uri)) {
            $this->endpoint = 'API';
        } else if (preg_match('#/admin/#', $this->uri)) {
            $this->endpoint = 'ADMIN';
        } else {
            $this->endpoint = 'WEB';
        }

        $this->input = $_REQUEST;

        $this->findIp();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];

        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getRequestedRoute()
    {
        return $this->requestedRoute;
    }

    public function setRequestedRoute($requestedRoute)
    {
        $this->requestedRoute = $requestedRoute;
    }

    public function input($key = null)
    {
        if ($key === null) {
            return $this->input;
        }

        if (array_key_exists($key, $this->input)) {
            return $this->input[$key];
        }
    }

    public function empty($key)
    {
        if (array_key_exists($key, $this->input)) {
            if ($this->input[$key] !== "" || $this->input[$key] !== null) {
                return false;
            }
        }

        return true;

    }

    public function findIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $this->ip = $ip;

        return $this->ip;
    }

    public function findUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function ip()
    {
        return $this->ip;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setInput($input)
    {
        $this->input = $input;
    }
}
