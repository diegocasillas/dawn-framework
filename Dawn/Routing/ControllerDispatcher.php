<?php

namespace Dawn\Routing;

use App\Controllers\Auth;
use App\Controllers;

class ControllerDispatcher
{
    protected $app;
    protected $dispatchedController;
    protected $action;
    protected $parameters;
    protected $options;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function prepare($request)
    {
        $route = $request->getRequestedRoute();

        $controller = $route->controller();
        $this->action = $route->action();
        $this->parameters = $route->parameters();
        $this->options = $route->options();

        $this->dispatchedController = new $controller();
        $this->dispatchedController->setApp($this->app);
        $this->dispatchedController->setRequest($request);
        $this->dispatchedController->init();

        return $this;
    }

    public function dispatch()
    {
        return $this->dispatchedController->callAction($this->action, $this->parameters, $this->options);
    }


}