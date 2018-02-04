<?php

class ControllerDispatcher
{
    public static function dispatch(Route $route)
    {
        $controller = $route->controller();
        $action = $route->action();
        $parameters = $route->parameters();
        $options = $route->options();

        return (new $controller())->callAction($action, $parameters, $options);
    }
}