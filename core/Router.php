<?php

class Router
{
    private $routes;
    private $request;
    private $accessedRoute;

    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];

        $this->load(ROUTES);
    }

    public static function start()
    {
        $router = new static;
        $router->getRequest()->process()->direct();
    }

    private function load($routes)
    {
        require $routes;
    }

    private function getRequest()
    {
        $this->request = Request::get();

        return $this;
    }

    private function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['GET'], $route);

        return $route;
    }

    private function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['POST'], $route);

        return $route;
    }

    private function process()
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

    private function direct()
    {
        if (Auth::check($this->accessedRoute->authorization)) {
            return $this->callAction(
                $this->accessedRoute->controller(),
                $this->accessedRoute->action(),
                $this->accessedRoute->parameters()
            );
        }

        return redirect('login');
    }

    private function accessGranted()
    {
        $authorization = $this->accessedRoute->authorization;

        if (in_array('guests', $this->accessedRoute->authorization)) {
            if (Auth::check($authorization)) {
                return true;
            }
        }

        return false;

        if (in_array('authenticated', $this->accessedRoute->authorization)) {
            if (!Auth::check()) {
                return false;
            }
        }

        if (in_array('owner', $this->accessedRoute->authorization)) {
            if (!Auth::check()) {
                return false;
            }
        }

        return true;
    }

    private function callAction($controller, $action, array $parameters)
    {
        $controller = new $controller;

        return $controller->$action(...$parameters);
    }
}
