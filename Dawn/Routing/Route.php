<?php

namespace Dawn\Routing;

class Route
{
    public $originalUri;
    public $uri;
    public $method;
    public $controller;
    public $action;
    private $parameters = [];
    public $options = [];
    public $name;

    public function __construct($uri, $method, $controller, $action, $parameters = [])
    {
        $this->originalUri = $uri;
        $this->uri = $this->replaceUri($uri);
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
    }

    public function replaceUri($uri)
    {
        $replaced = str_replace('{any}', '(.+)', $uri);
        $key = str_replace('{id}', '([0-9]+)', $replaced);

        return $key;
    }

    public function auth(...$parameters)
    {
        foreach ($parameters as $parameter) {
            array_push($this->options, $parameter);
        }

        return $this;
    }

    public function controller()
    {
        return $this->controller;
    }

    public function action()
    {
        return $this->action;
    }

    public function parameters()
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function options()
    {
        return $this->options;
    }

    public function name($name)
    {
        $this->name = $name;
    }

    public function getOriginalUri()
    {
        return $this->originalUri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
}
