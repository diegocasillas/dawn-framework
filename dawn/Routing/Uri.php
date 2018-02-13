<?php

class Uri
{
    protected $uri;
    protected $parameters = [];

    public function __construct($uri)
    {
        $this->uri = uri;
        $this->parameters = $this->findParameters();
    }

    public function findParameters()
    {

    }
}
