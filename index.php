<?php

require 'core/bootstrap.php';

Session::start();

$router = Router::load('core/routes.php');
// $request = $router->request();

$router->getRequest()->process()->direct();
