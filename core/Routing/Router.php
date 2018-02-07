<?php

class Router
{
    private $routes = [
        'WEB' => [
            'GET' => [],
            'POST' => []
        ],
        'API' => [
            'GET' => [],
            'POST' => [],
            'PUT' => [],
            'PATCH' => [],
            'DELETE' => []
        ]
    ];
    private $request;
    private $requestedRoute;

    private function __construct()
    {
        $this->load();
    }

    // private function api($uri, $controller,)

    private function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['WEB']['GET'], $route);

        return $route;
    }

    private function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, $controller, $action, $parameters);
        array_push($this->routes['WEB']['POST'], $route);

        return $route;
    }

    private function load()
    {
        require ROUTES;
        require ROUTES_API;

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
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();
        $endpoint = $this->request->getEndpoint();

        foreach ($this->routes[$endpoint][$method] as $route) {
            if (preg_match('#^' . $route->uri . '$#', $uri, $parameters)) {
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
