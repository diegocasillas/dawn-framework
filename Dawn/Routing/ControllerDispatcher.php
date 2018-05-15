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

        $this->dispatchedController = new $route->controller();
        $this->action = $route->action();
        $this->parameters = $route->parameters();
        $this->options = $route->options();

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
}
