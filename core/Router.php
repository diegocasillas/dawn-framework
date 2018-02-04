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

        if ($this->accessedRoute === null) {
            return redirect('404');
        }

        return $this;
    }

    public function accessedRoute()
    {
        return $this->accessedRoute;
    }

    private function direct()
    {
        return $this->callAction();
    }

    private function callAction()
    {
        $controller = $this->accessedRoute->controller();
        $authorization = $this->accessedRoute->authorization;
        $action = $this->accessedRoute->action();
        $parameters = $this->accessedRoute->parameters();

        return (new $controller())->middleware($authorization, $action, $parameters);
    }
}
