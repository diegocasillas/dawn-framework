<?php

require 'vendor/autoload.php';

define('CONFIG', require 'config.php');

use Dawn\Session;
use Dawn\App;

Session::start();

$app = new App('Dawn', __DIR__);

return $app->bootstrap(CONFIG['service providers']);