<?php

namespace Dawn\Routing;

/**
 * Processes the request and serves the needed data to the controller dispatcher.
 */
class Router
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    protected $app;

    /**
     * The controller dispatcher instance.
     *
     * @var Dawn\Routing\ControllerDispatcher
     */
    protected $controllerDispatcher;

    /**
     * Array that contains the paths to the routes files.
     *
     * @var array
     */
    protected $routesFiles = [];

    /**
     * Array that contains the loaded routes.
     *
     * @var array
     */
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

    /**
     * The request instance.
     *
     * @var Dawn\Routing\Request
     */
    protected $request;

    /**
     * The requested route instance.
     *
     * @var Dawn\Routing\Route
     */
    protected $requestedRoute;

    /**
     * The response instance.
     *
     * @var Dawn\Routing\Response
     */
    protected $response;

    /**
     * Create a new Router instance.
     *
     * @param Dawn\App\App $app
     * @param array $routesFiles
     */
    public function __construct($app = null, $routesFiles = null)
    {
        $this->app = $app;
        $this->routesFiles = $routesFiles;
    }

    /**
     * Start the router.
     *
     * @return $this
     */
    public function start()
    {
        $this->loadRoutes()->loadRequest()->processRequest()->direct();

        return $this;
    }

    /**
     * Load the routes requiring the routes files.
     *
     * @return $this
     */
    protected function loadRoutes()
    {
        foreach ($this->routesFiles as $routesFile) {
            require $routesFile;
        }

        return $this;
    }

    /**
     * Get the prepared request.
     *
     * @return $this
     */
    protected function loadRequest()
    {
        $this->request->get();

        return $this;
    }

    /**
     * Find the requested route.
     *
     * @return $this
     */
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

    /**
     * Direct the request to the controller dispatcher.
     *
     * @return void
     */
    protected function direct()
    {
        return $this->controllerDispatcher->prepare($this->request)->dispatch();
    }

    /**
     * Add a route to the routes array.
     *
     * @param string $endpoint
     * @param string $method
     * @param Dawn\Routing\Route $route
     * @return void
     */
    protected function addRoute($endpoint, $method, $route)
    {
        array_push($this->routes[$endpoint][$method], $route);
    }

    /**
     * Add a GET route to the routes array.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param array $parameters
     * @return void
     */
    protected function get($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'GET', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->addRoute('WEB', 'GET', $route);

        return $route;
    }

    /**
     * Add a POST route to the routes array.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param array $parameters
     * @return void
     */
    protected function post($uri, $controller, $action, $parameters = [])
    {
        $route = new Route($uri, 'POST', "App\\Controllers\\{$controller}", $action, $parameters);
        $this->addRoute('WEB', 'POST', $route);

        return $route;
    }

    /**
     * Get the app instance.
     *
     * @return Dawn\App\App
     */
    public function getApp()
    {
        return $this->app = $app;
    }

    /**
     * Set the app instance.
     *
     * @param Dawn\App\App $app
     * @return void
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * Get the controller dispatcher instance.
     *
     * @return Dawn\Routing\ControllerDispatcher
     */
    public function getControllerDispatcher()
    {
        return $this->controllerDispatcher;
    }

    /**
     * Set the controller dispatcher instance.
     *
     * @param Dawn\Routing\ControllerDispatcher $controllerDispatcher
     * @return void
     */
    public function setControllerDispatcher($controllerDispatcher)
    {
        $this->controllerDispatcher = $controllerDispatcher;
    }

    /**
     * Get the routes files array.
     *
     * @return array
     */
    public function getRoutesFiles()
    {
        return $this->routesFiles;
    }

    /**
     * Set the routes files array.
     *
     * @param array $routesFiles
     * @return void
     */
    public function setRoutesFiles($routesFiles)
    {
        $this->routesFiles = $routesFiles;
    }

    /**
     * Get the routes array.
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the routes array.
     *
     * @param array $routes
     * @return void
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    /**
     * Get the request instance.
     *
     * @return Dawn\Routing\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the request instance.
     *
     * @param Dawn\Routing\Request $request
     * @return void
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Get the requested route instance.
     *
     * @return Dawn\Routing\Route
     */
    public function getRequestedRoute()
    {
        return $this->requestedRoute;
    }

    /**
     * Set the requested route instance.
     *
     * @param Dawn\Routing\Route $requestedRoute
     * @return void
     */
    public function setRequestedRoute($requestedRoute)
    {
        $this->requestedRoute = $requestedRoute;
    }

    /**
     * Get the response instance.
     *
     * @return Dawn\Routing\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response instance.
     *
     * @param Dawn\Routing\Response $response
     * @return void
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
