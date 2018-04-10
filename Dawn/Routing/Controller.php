<?php

namespace Dawn\Routing;

use \ReflectionClass;
use Dawn\Auth\Middleware;

abstract class Controller
{
    protected $app;
    protected $model;
    protected $middleware;

    public function __construct()
    {
        $this->model = str_replace('Controller', '', (new ReflectionClass(get_class($this)))->getShortName());
    }

    // Sends the requested action through a middleware
    public function callAction($action, $parameters = [], $options = null)
    {

        $this->middleware = new Middleware($this, $this->app->get('auth'));

        $this->middleware->setOptions($options);
        $this->middleware->setNext($action, $parameters);
        $this->middleware->setParameters($parameters, $this->model);
        $this->middleware->handle($action, $parameters);

    }

    public function getApp()
    {
        return $this->app;
    }

    public function setApp($app)
    {
        $this->app = $app;
    }
}