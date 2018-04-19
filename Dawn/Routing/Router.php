<?php

namespace Dawn\Routing;

class Router
{
    protected $app;
    protected $controllerDispatcher;
    protected $routesFiles = [];
    protected $routes = [
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
    protected $request;
    protected $requestedRoute;
    protected $response;

    public function __construct($app = null, $routesFiles = null)
    {
        $this->app = $app;
        $this->routesFiles = $routesFiles;
    }

    public function start()
    {
        $this->loadRoutes()->loadRequest()->processRequest()->direct();

        return $this;
    }

    protected function loadRoutes()
    {
        foreach ($this->routesFiles as $routesFile) {
            require $routesFile;
        }

        return $this;
    }

    protected function loadRequest()
    {
        $this->request->get();

        return $this;
    }

    protected function processRequest()
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
                $this->request->setRequestedRoute($route);
            }
        }

        if ($this->requestedRoute === null) {
            return redirect('404');
        }

        return $this;
    }

    protected function direct()
    {
        return $this->controllerDispatcher->prepare($this->request)->dispatch();
    }

        // protected function api($uri, $controller,)
    protected function addRoute($endpoint, $method, $route)
    {
        array_push($this->routes[$endpoint][$method], $route);
    }

    protected function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'GET', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->addRoute('WEB', 'GET', $route);

        return $route;
    }

    protected function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'POST', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->addRoute('WEB', 'POST', $route);

        return $route;
    }

    protected function adminGet($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'GET', "Dawn\\Admin\\Controllers\\{$controller}", $action, $parameters);
        $this->addRoute('ADMIN', 'GET', $route);

        return $route;
    }

    public function setControllerDispatcher($controllerDispatcher)
    {
        $this->controllerDispatcher = $controllerDispatcher;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
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
