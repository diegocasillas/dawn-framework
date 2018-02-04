<?php

class Middleware
{
    public $controller;
    public $options;
    public $next;
    public $parameters = [];
    public $model;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function setOptions($options = [])
    {
        $this->options = $options;

    }

    public function setNext($action, $parameters)
    {
        $this->next = function () use ($action, $parameters) {
            $this->controller->$action(...$parameters);
        };
    }

    public function setParameters($parameters, $model)
    {
        if ($parameters !== []) {
            $ownerId = $model::find(...$parameters)->userId();
            array_push($this->parameters, $ownerId);
        }

    }

    public function handle($action, $parameters)
    {
        if (Auth::check($this->options, ...$this->parameters)) {
            $this->controller->$action(...$parameters);
        } else {
            if (!Auth::authenticated()) {
                return redirect('login');
            }

            redirect('401');
        }
    }

    public function next()
    {
        return $this->next;
    }
}