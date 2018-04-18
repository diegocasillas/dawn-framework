<?php

namespace Dawn\Routing;

class Request
{
    protected $uri;
    protected $method;
    protected $endpoint;
    protected $requestedRoute;

    public static function get()
    {
        $request = new static;

        $request->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $request->method = $_SERVER['REQUEST_METHOD'];

        if (preg_match('#/api/#', $request->uri)) {
            $request->endpoint = 'API';
        } else if (preg_match('#/admin/#', $request->uri)) {
            $request->endpoint = 'ADMIN';
        } else {
            $request->endpoint = 'WEB';
        }

        return $request;
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
}
