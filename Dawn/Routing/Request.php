<?php

namespace Dawn\Routing;

class Request
{
    protected $uri;
    protected $method;
    protected $endpoint;
    protected $requestedRoute;

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
}
