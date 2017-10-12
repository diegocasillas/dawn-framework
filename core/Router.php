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

        // $router->routes = $routes;
        require $routes;

        return $router;
    }

    public function get($uri, $controller, $action)
    {
        $this->routes['GET'][$uri]['controller'] = $controller;
        $this->routes['GET'][$uri]['action'] = $action;
    }

    public function post($uri, $controller, $action)
    {
        $this->routes['POST'][$uri]['controller'] = $controller;
        $this->routes['POST'][$uri]['action'] = $action;
    }

    public function direct($uri, $requestType)
    {
        return $this->callAction(
            $this->routes[$requestType][$uri]['controller'],
            $this->routes[$requestType][$uri]['action']
        );
    }

    public function callAction($controller, $action)
    {
        $controller = new $controller;

        return $controller->$action();
    }
}
