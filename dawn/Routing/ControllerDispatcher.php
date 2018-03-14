<?php

namespace Dawn\Routing;

use App\Controllers;

class ControllerDispatcher
{
    public static function dispatch(Route $route)
    {
        $controller = "\\App\\Controllers\\{$route->controller()}";
        $action = $route->action();
        $parameters = $route->parameters();
        $options = $route->options();

        return (new $controller())->callAction($action, $parameters, $options);
    }
}