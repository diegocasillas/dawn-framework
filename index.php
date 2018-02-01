<?php

require 'core/bootstrap.php';

$router = Router::load('core/routes.php');
$request = $router->request();

// compare the uri with the router's uris (with the method)
    // if its found, return the route
$route = $router->getRoute(
    $request->getUri(),
    $request->getMethod()
);

// having the route and the parameters, call the controller->action($parameters)
$router->direct($route);