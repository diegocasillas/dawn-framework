<?php

class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = str_replace('Controller', '', get_class($this));
    }

    // Sends the requested action through a middleware
    public function callAction($action, $parameters = [], $options = null)
    {
        // Wraps the requested action in an anonymous function for the middleware
        $next = function () use ($action, $parameters) {
            $this->$action(...$parameters);
        };

        if ($parameters !== []) {
            $ownerId = $this->model::find(...$parameters)->userId();

            $parameters = [];
            array_push($parameters, $ownerId);
        }

        $this->middleware($options, $next, ...$parameters);
    }

    public function middleware($options, $next, ...$parameters)
    {
        if (Auth::check($options, ...$parameters)) {
            $next();
        } else {
            if (!Auth::authenticated()) {
                return redirect('login');
            }

            redirect('401');
        }
    }

    // public function middleware($authorization = [], $next, $parameters = [])
    // {
    //     if (Auth::check($authorization, $this->model, ...$parameters)) {
    //         $this->$next(...$parameters);
    //     } else {
    //         if (!Auth::authenticated()) {
    //             return redirect('login');
    //         }

    //         redirect('401');
    //     }
    // }
}