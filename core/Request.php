<?php

class Request
{
    protected $uri;
    protected $method;

    public static function get()
    {
        $request = new static;

        $request->uri = $request->setUri();
        $request->method = $request->setMethod();

        return $request;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri()
    {
      return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
