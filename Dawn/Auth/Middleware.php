<?php

namespace Dawn\Auth;

class Middleware
{
    public $controller;
    public $auth;
    public $options;
    public $next;
    public $parameters = [];
    public $model;

    public function __construct($controller, $auth)
    {
        $this->controller = $controller;
        $this->auth = $auth;
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
        $model = "\\App\\Models\\{$model}";

        if ($parameters !== []) {
            $ownerId = (new $model())->find(...$parameters)->userId();
            array_push($this->parameters, $ownerId);
        }
    }

    public function handle($action, $parameters)
    {
        if ($this->auth->check($this->options, ...$this->parameters)) {

            $this->controller->$action(...$parameters);
        } else {
            if (!$this->auth->authenticated()) {
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