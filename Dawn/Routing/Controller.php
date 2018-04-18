<?php

namespace Dawn\Routing;

use \ReflectionClass;
use Dawn\Auth\Middleware;

abstract class Controller
{
    protected $app;
    protected $model;
    protected $middleware;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->model = str_replace('Controller', '', (new ReflectionClass(get_class($this)))->getShortName());
    }

    public function init()
    {
        $this->response = new Response();
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

    public function response($data, $statusCode = 200)
    {
        $this->response->data($data);
        $this->response->status($statusCode);

        return $this->response;
    }

    public function getApp()
    {
        return $this->app;
    }

    public function setApp($app)
    {
        $this->app = $app;
    }

    public function getRequest()
    {
        $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getResponse()
    {
        $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }
}