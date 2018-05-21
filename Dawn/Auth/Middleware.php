<?php

namespace Dawn\Auth;

use Dawn\Routing\Controller;

/**
 * Handles the request before the controller.
 */
class Middleware
{
    /**
     * The controller instance.
     *
     * @var Dawn\Routing\Controller
     */
    protected $controller;

    /**
     * The auth instance.
     *
     * @var Dawn\Auth\Auth
     */
    protected $auth;

    /**
     * Array of options to handle.
     *
     * @var array
     */
    protected $options;

    /**
     * Prepared callback.
     *
     * @var callback
     */
    protected $next;

    /**
     * Array of parameters for the callback.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Full name of the model class.
     *
     * @var string
     */
    protected $model;

    /**
     * Create a new Middleware instance.
     *
     * @param Dawn\Routing\Controller $controller
     * @param Dawn\Auth\Auth $auth
     */
    public function __construct(Controller $controller, Auth $auth)
    {
        $this->controller = $controller;
        $this->auth = $auth;
    }

    /**
     * Handle the request checking that the options are fullfilled.
     *
     * @param string $action
     * @param mixed $parameters
     * @return void
     */
    public function handle($action, $parameters)
    {
        if ($this->auth->check($this->options, ...$this->parameters)) {
            $this->controller->$action(...$parameters);
        } else {
            if (!$this->auth->authenticated()) {
                return redirect('login');
            }

            redirect('401');
        }
    }

    /**
     * Set the options array.
     *
     * @param array $options
     * @return void
     */
    public function setOptions(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Set the callback function.
     *
     * @param string $action
     * @param mixed $parameters
     * @return void
     */
    public function setNext(string $action, $parameters)
    {
        $this->next = function () use ($action, $parameters) {
            $this->controller->$action(...$parameters);
        };
    }

    /**
     * Set the parameters array.
     *
     * @param mixed $parameters
     * @param string $model
     * @return void
     */
    public function setParameters($parameters, $model)
    {
        $model = "\\App\\Models\\{$model}";

        if ($parameters !== []) {
            $owner = (new $model())->find(...$parameters);
            if ($owner !== null) {
                $ownerId = (new $model())->find(...$parameters)->getId();
                array_push($this->parameters, $ownerId);
            }
        }
    }

    /**
     * Call the callback function.
     *
     * @return callback
     */
    public function next()
    {
        return $this->next;
    }

    /**
     * Get the controller instance.
     *
     * @return void
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the controller instance.
     *
     * @param Dawn\Routing\Controller $controller
     * @return void
     */
    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Get the auth instance.
     *
     * @return Dawn\Auth\Auth
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Set the auth instance.
     *
     * @param Dawn\Auth\Auth $auth
     * @return void
     */
    public function setAuth(Auth $auth)
    {
        $this->auth = $auth;
    }
}
