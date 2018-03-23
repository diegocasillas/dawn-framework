<?php

namespace Dawn\Routing;

class Router
{
    private $app;
    private $routesFiles = [];
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
        ],
        'ADMIN' => [
            'GET' => [],
            'POST' => []
        ]
    ];
    private $request;
    private $requestedRoute;

    public function __construct($app = null)
    {
        $this->app = $app;
        $this->routesFiles = $app->getConfig()['routes'];
    }

    // private function api($uri, $controller,)
    private function map($endpoint, $method, $route)
    {
        array_push($this->routes[$endpoint][$method], $route);
    }

    private function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'GET', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->map('WEB', 'GET', $route);

        return $route;
    }

    private function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'POST', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->map('WEB', 'POST', $route);

        return $route;
    }

    private function adminGet($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'GET', "Dawn\\Admin\\Controllers\\{$controller}", $action, $parameters);
        $this->map('ADMIN', 'GET', $route);

        return $route;
    }

    public function load()
    {
        $router = $this;

        foreach ($this->routesFiles as $routesFile) {
            require $routesFile;
        }

        return $this;
    }

    public function start()
    {
        $this->load()->getRequest()->processRequest()->direct();

        return $this;
    }

    private function getRequest()
    {
        $this->request = Request::get();

        return $this;
    }

    private function processRequest()
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

    private function direct()
    {
        return ControllerDispatcher::dispatch($this->requestedRoute);
    }

    public function requestedRoute()
    {
        return $this->requestedRoute;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
