<?php

class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = str_replace('Controller', '', get_class($this));
    }

    public function middleware($authorization = [], $next, $parameters = [])
    {
        if (Auth::check($authorization, $this->model, ...$parameters)) {
            $this->$next(...$parameters);
        } else {
            redirect();
        }
    }
}