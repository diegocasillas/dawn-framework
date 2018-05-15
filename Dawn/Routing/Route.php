<?php

namespace Dawn\Routing;

/**
 * Holds a route's information.
 */
class Route
{
    /**
     * The original accessed URI.
     *
     * @var string
     */
    private $originalUri;

    /**
     * The URI that matches the accessed URI.
     *
     * @var string
     */
    private $uri;

    /**
     * The method of the route.
     *
     * @var string
     */
    private $method;

    /**
     * The controller name.
     *
     * @var string
     */
    private $controller;

    /**
     * The action name.
     *
     * @var string
     */
    private $action;

    /**
     * Array that contains the route's parameters.
     *
     * @var array
     */
    private $parameters = [];

    /**
     * Array that contains the route's options.
     *
     * @var array
     */
    private $options = [];

    /**
     * The name of the route.
     *
     * @var string
     */
    private $name;

    /**
     * Create a new Route instance.
     *
     * @param string $uri
     * @param string $method
     * @param string $controller
     * @param string $action
     * @param array $parameters
     */
    public function __construct($uri, $method, $controller, $action, $parameters = [])
    {
        $this->originalUri = $uri;
        $this->uri = $this->replaceUri($uri);
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
    }

    /**
     * Replace the wildcard values of the URI by regex.
     *
     * @param string $uri
     * @return string
     */
    public function replaceUri($uri)
    {
        $replaced = str_replace('{any}', '(.+)', $uri);
        $key = str_replace('{id}', '([0-9]+)', $replaced);

        return $key;
    }

    /**
     * Add the auth parameters to the parameters array.
     *
     * @param mixed ...$parameters
     * @return $this
     */
    public function auth(...$parameters)
    {
        foreach ($parameters as $parameter) {
            array_push($this->options, $parameter);
        }

        return $this;
    }

    /**
     * Get the original URI.
     *
     * @return string
     */
    public function getOriginalUri()
    {
        return $this->originalUri;
    }

    /**
     * Set the original URI.
     *
     * @param string $originalUri
     * @return void
     */
    public function setOriginalUri($originalUri)
    {
        $this->originalUri = $originalUri;
    }

    /**
     * Get the URI.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set the URI.
     *
     * @param string $uri
     * @return void
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the method name.
     *
     * @param string $method
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Get the controller name.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the controller name.
     *
     * @param string $controller
     * @return void
     */
    public function setController($controller)
    {
        $this->controller = $controller;
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
     * Get the parameters array.
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
    public function setParameters(array $parameters = [])
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

    /**
     * Get the route name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the route name.
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
