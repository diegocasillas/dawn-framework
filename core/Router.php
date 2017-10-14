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

    // public function direct($uri, $requestType)
    // {
    //     return $this->callAction(
    //         $this->routes[$requestType][$uri]['controller'],
    //         $this->routes[$requestType][$uri]['action']
    //     );
    // }

    public function direct($uri, $requestType)
    {
        foreach ($this->routes[$requestType] as $index => $val) {
            $replaced = str_replace(':any', '.+', $index);
            $key = str_replace(':id', '[0-9]+', $replaced);

            if (preg_match('#^'.$key.'$#', $uri, $parameters)) {
                if (isset($parameters[0])) {
                    unset($parameters[0]);
                }

                return $this->callAction(
                    $this->routes[$requestType][$index]['controller'],
                    $this->routes[$requestType][$index]['action'],
                    $parameters
                );
            }
        }
    }

    public function callAction($controller, $action, $parameters)
    {
        $controller = new $controller;

        return $controller->$action(...$parameters);
    }
}
