<?php

class Route
{
    public $uri;
    public $controller;
    public $action;
    private $parameters = [];

    public function __construct($uri, $controller, $action, $parameters = [])
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }
}
