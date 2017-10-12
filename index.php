<?php

require 'core/bootstrap.php';

$router = Router::load('core/routes.php');
$router->direct(Request::uri(), Request::method());
