<?php

namespace Dawn\Routing;

/**
 * Gets the request information.
 */
class Request
{
    /**
     * The request URI.
     *
     * @var string
     */
    protected $uri;

    /**
     * The request method.
     *
     * @var string
     */
    protected $method;

    /**
     * The request endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * The requested route.
     *
     * @var Dawn\Routing\Route
     */
    protected $requestedRoute;

    /**
     * Array that contains the input from the request.
     *
     * @var array
     */
    protected $input = [];

    /**
     * The IP address that made the request.
     *
     * @var string
     */
    protected $ip;

    /**
     * The user agent that made the request.
     *
     * @var string
     */
    protected $userAgent;

    /**
     * Get the request information.
     *
     * @return $this
     */
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

    /**
     * Return a specific input value by its key. If the key is empty, return every value.
     *
     * @param strings $key
     * @return mixed
     */
    public function input($key = null)
    {
        if ($key === null) {
            return $this->input;
        }

        if (array_key_exists($key, $this->input)) {
            return $this->input[$key];
        }
    }

    /**
     * Check if a specific input value is empty.
     *
     * @param string $key
     * @return boolean
     */
    public function empty($key)
    {
        if (array_key_exists($key, $this->input)) {
            if ($this->input[$key] !== "" || $this->input[$key] !== null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Find the IP address that made the request.
     *
     * @return string
     */
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

    /**
     * Find the user agent that made the request.
     *
     * @return string
     */
    public function findUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Get the URI.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set the URI.
     *
     * @param string $uri
     * @return void
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the method name.
     *
     * @param string $method
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Get the endpoint name.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the endpoint name.
     *
     * @param string $endpoint
     * @return void
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Get the requested route instance.
     *
     * @return Dawn\Routing\Route
     */
    public function getRequestedRoute()
    {
        return $this->requestedRoute;
    }

    /**
     * Set the requested route instance.
     *
     * @param Dawn\Routing\Route $requestedRoute
     * @return void
     */
    public function setRequestedRoute($requestedRoute)
    {
        $this->requestedRoute = $requestedRoute;
    }

    /**
     * Get the input array.
     *
     * @return array
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the input array.
     *
     * @param array $input
     * @return void
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * Get the IP address.
     *
     * @return void
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set the IP address.
     *
     * @param string $ip
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get the user agent name.
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set the user agent name.
     *
     * @param string $userAgent
     * @return void
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }
}
