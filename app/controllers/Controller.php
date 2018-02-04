<?php

abstract class Controller
{
    public $model;
    public $middleware;

    public function __construct()
    {
        $this->model = str_replace('Controller', '', get_class($this));
    }

    // Sends the requested action through a middleware
    public function callAction($action, $parameters = [], $options = null)
    {
        $this->middleware = new Middleware($this);
        $this->middleware->setOptions($options);
        $this->middleware->setNext($action, $parameters);
        $this->middleware->setParameters($parameters, $this->model);
        $this->middleware->handle($action, $parameters);
    }
}