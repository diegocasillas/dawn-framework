<?php

class Route
{
    public $uri;
    public $controller;
    public $action;
    private $parameters = [];
    public $authorization = [];

    public $isProtected;
    public $isForGuests;

    public function __construct($uri, $controller, $action, $parameters = [], $authorization = [])
    {
        $this->uri = $this->replaceUri($uri);
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
        $this->isProtected = false;
        $this->authorization = $authorization;
    }

    public function authorization(...$parameters)
    {
        foreach ($parameters as $parameter) {
            array_push($this->authorization, $parameter);
        }
    }

    public function protected()
    {
        $this->isProtected = true;
    }

    public function guests()
    {
        $this->isForGuests = true;
    }

    public function replaceUri($uri)
    {
        $replaced = str_replace(':any', '.+', $uri);
        $key = str_replace(':id', '[0-9]+', $replaced);

        return $key;
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
}
