<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    private $accessedRoute;
    private $request;

    public static function load($routes)
    {
        $router = new static;

        require $routes;

        return $router;
    }

    public function getRequest()
    {
        $this->request = Request::get();

        return $this;
    }

    public function request()
    {
        return $this->request;
    }

    public function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['GET'], $route);

        return $route;
    }

    public function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['POST'], $route);

        return $route;
    }

    public function process()
    {
        $requestMethod = $this->request->getMethod();
        $requestUri = $this->request->getUri();

        foreach ($this->routes[$requestMethod] as $route) {
            if (preg_match('#^' . $route->uri . '$#', $requestUri, $parameters)) {
                if (isset($parameters[0])) {
                    unset($parameters[0]);
                }

                $route->setParameters($parameters);

                $this->accessedRoute = $route;
            }
        }

        return $this;
    }

    public function accessedRoute()
    {
        return $this->accessedRoute;
    }

    public function direct()
    {
        if ($this->hasAccess()) {
            return $this->callAction(
                $this->accessedRoute->controller(),
                $this->accessedRoute->action(),
                $this->accessedRoute->parameters()
            );
        }

        return redirect('login');
    }

    public function hasAccess()
    {
        if (in_array('guests', $this->accessedRoute->authorization)) {
            if (Auth::check()) {
                return false;
            }
        }

        if (in_array('authenticated', $this->accessedRoute->authorization)) {
            if (!Auth::check()) {
                return false;
            }
        }

        return true;
    }

    public function callAction($controller, $action, array $parameters)
    {
        $controller = new $controller;

        return $controller->$action(...$parameters);
    }
}
