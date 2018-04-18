<?php

namespace Dawn\Routing;

use App\Controllers\Auth;
use App\Controllers;

class ControllerDispatcher
{
    public static function dispatch($app, Route $route)
    {
        $controller = $route->controller();
        $action = $route->action();
        $parameters = $route->parameters();
        $options = $route->options();

        $dispatchedController = new $controller();
        $dispatchedController->setApp($app);
        $dispatchedController->init();

        return $dispatchedController->callAction($action, $parameters, $options);
    }
}