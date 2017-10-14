<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($routes)
    {
        $router = new static;

        require $routes;

        return $router;
    }

    public function request()
    {
        return Request::get();
    }

    public function get($route)
    {
        array_push($this->routes['GET'], $route);
    }

    public function post($route)
    {
        array_push($this->routes['POST'], $route);
    }

    public function getRoute($uri, $requestType)
    {
        foreach ($this->routes[$requestType] as $route)
        {
            if (preg_match('#^'.$route->uri.'$#', $uri, $parameters)) {
                if (isset($parameters[0])) {
                    unset($parameters[0]);
                }

                $route->setParameters($parameters);
                return $route;
            }
        }
    }

    public function direct($route)
    {
        return $this->callAction(
            $route->controller,
            $route->action,
            $route->getParameters()
        );
    }

    public function callAction($controller, $action, array $parameters)
    {
        $controller = new $controller;

        return $controller->$action(...$parameters);
    }
}
