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
        return $router;
    }

    private function load($routes)
    {
        require $routes;
    }

    public function getRequest()
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

        if ($this->accessedRoute === null) {
            return redirect('404');
        }

        return $this;
    }

    public function accessedRoute()
    {
        return $this->accessedRoute;
    }

    public function direct()
    {
        return ControllerDispatcher::dispatch($this->accessedRoute);
    }
}
