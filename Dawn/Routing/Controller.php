<?php

namespace Dawn\Routing;

use \ReflectionClass;
use Dawn\Auth\Middleware;

/**
 * Class to be extended by controllers
 */
abstract class Controller
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    protected $app;

    /**
     * The name of the model handled by the controller.
     *
     * @var string
     */
    protected $model;

    /**
     * The middleware instance that handles the request.
     *
     * @var Dawn\Auth\Middleware
     */
    protected $middleware;

    /**
     * The current request instance.
     *
     * @var Dawn\Routing\Request
     */
    protected $request;

    /**
     * The current response instance.
     *
     * @var @var Dawn\Routing\Response
     */
    protected $response;

    /**
     * Create a new Controller instance.
     */
    public function __construct()
    {
        $this->model = str_replace('Controller', '', (new ReflectionClass(get_class($this)))->getShortName());
    }

    /**
     * Initializes the controller.
     *
     * @return void
     */
    public function init()
    {
        $this->response = new Response();
    }

    /**
     * Call the requested action through a middleware.
     *
     * @param string $action
     * @param array $parameters
     * @param array $options
     * @return void
     */
    public function callAction($action, $parameters = [], $options = null)
    {
        $this->middleware = new Middleware($this, $this->app->get('auth'));

        $this->middleware->setOptions($options);
        $this->middleware->setNext($action, $parameters);
        $this->middleware->setParameters($parameters, $this->model);
        $this->middleware->handle($action, $parameters);
    }

    /**
     * Return a response object.
     *
     * @param array $data
     * @param integer $statusCode
     * @return Dawn\Routing\Response
     */
    public function response($data, $statusCode = 200)
    {
        $this->response->data($data);
        $this->response->status($statusCode);

        return $this->response;
    }

    /**
     * Return a specific input value by its key. If the key is empty, return every value.
     *
     * @param strings $key
     * @return mixed
     */
    public function input($key = null)
    {
        return $this->request->input($key);
    }

    /**
     * Check if a specific input value is empty.
     *
     * @param string $key
     * @return boolean
     */
    public function empty($key)
    {
        return $this->request->empty($key);
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
     * Get the model name.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the model name.
     *
     * @param string $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get the middleware instance.
     *
     * @return Dawn\Auth\Middleware
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Set the middleware instance
     *
     * @param Dawn\Auth\Middleware $middleware
     * @return void
     */
    public function setMiddleware($middleware)
    {
        $this->middleware = $middleware;
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
