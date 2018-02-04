<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];
    private $request;
    private $requestedRoute;

    private function __construct()
    {
        $this->load(ROUTES);
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

    private function load(String $routes)
    {
        require $routes;
    }

    public static function start()
    {
        $router = new static;

        return $router;
    }

    public function getRequest()
    {
        $this->request = Request::get();

        return $this;
    }

    public function processRequest()
    {
        $requestMethod = $this->request->getMethod();
        $requestUri = $this->request->getUri();

        foreach ($this->routes[$requestMethod] as $route) {
            if (preg_match('#^' . $route->uri . '$#', $requestUri, $parameters)) {
                if (isset($parameters[0])) {
                    unset($parameters[0]);
                }

                $route->setParameters($parameters);
                $this->requestedRoute = $route;
            }
        }

        if ($this->requestedRoute === null) {
            return redirect('404');
        }

        return $this;
    }

    public function direct()
    {
        return ControllerDispatcher::dispatch($this->requestedRoute);
    }

    public function requestedRoute()
    {
        return $this->requestedRoute;
    }
}
