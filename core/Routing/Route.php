<?php

class Route
{
    public $uri;
    public $controller;
    public $action;
    private $parameters = [];
    public $options = [];

    public function __construct($uri, $controller, $action, $parameters = [])
    {
        $this->uri = $this->replaceUri($uri);
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
}
