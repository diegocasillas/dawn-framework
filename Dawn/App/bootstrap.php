<?php

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(dirname(__DIR__, 2));
$dotenv->load();

define('CONFIG', require 'config.php');

use Dawn\Session;
use Dawn\App\App;

$app = new App(CONFIG);

return $app->bootstrap();