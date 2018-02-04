<?php

require 'core/bootstrap.php';

Session::start();

$controller = Router::start()->getRequest()->processRequest()->direct();