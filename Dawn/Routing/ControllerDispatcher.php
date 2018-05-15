<?php

namespace Dawn\Routing;

use App\Controllers\Auth;
use App\Controllers;

/**
 * Prepares the controller and calls the action.
 */
class ControllerDispatcher
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    protected $app;

    /**
     * The controller to be dispatched.
     *
     * @var Dawn\Routing\Controller
     */
    protected $dispatchedController;

    /**
     * Action name.
     *
     * @var string
     */
    protected $action;

    /**
     * Array of parameters to be passed to the action.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Array of options to be passed to the action.
     *
     * @var [type]
     */
    protected $options;

    /**
     * Create a new Controller Dispatcher instance.
     *
     * @param Dawn\App\App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Prepare the controller.
     *
     * @param Dawn\Routing\Request $request
     * @return $this
     */
    public function prepare($request)
    {
        $route = $request->getRequestedRoute();
        $controller = $route->getController();

        $this->dispatchedController = new $controller;
        $this->action = $route->getAction();
        $this->parameters = $route->getParameters();
        $this->options = $route->getOptions();

        $this->dispatchedController->setApp($this->app);
        $this->dispatchedController->setRequest($request);
        $this->dispatchedController->init();

        return $this;
    }

    /**
     * Call the controller action.
     *
     * @return mixed
     */
    public function dispatch()
    {
        return $this->dispatchedController->callAction($this->action, $this->parameters, $this->options);
    }

    /**
     * Get the app instance.
     *
     * @return Dawn\App\App
     */
    public function getApp()
    {
        return $this->app;
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
     * Get the dispatched controller instance.
     *
     * @return Dawn\Routing\Controller
     */
    public function getDispatchedController()
    {
        return $this->dispatchedController;
    }

    /**
     * Set the dispatched controller instance
     *
     * @param Dawn\Routing\Controller $dispatchedController
     * @return void
     */
    public function setDispatchedController($dispatchedController)
    {
        $this->dispatchedController = $dispatchedController;
    }

    /**
     * Get the action name.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the action name.
     *
     * @param string $action
     * @return void
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Get the parameters array-
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set the parameters array.
     *
     * @param array $parameters
     * @return void
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Get the options array.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options array.
     *
     * @param array $options
     * @return void
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}
