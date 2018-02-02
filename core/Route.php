<?php

class Route
{
    public $uri;
    public $controller;
    public $action;
    private $parameters = [];

    public $isProtected;
    public $isForGuests;

    public function __construct($uri, $controller, $action, $parameters = [])
    {
        $this->uri = $this->replaceUri($uri);
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
        $this->isProtected = false;
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

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }
}
