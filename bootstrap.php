<?php

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

define('CONFIG', require 'config.php');

use Dawn\Session;
use Dawn\App;

Session::start();

$app = new App(CONFIG);

return $app->bootstrap();