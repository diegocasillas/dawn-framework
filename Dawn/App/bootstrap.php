<?php

require 'vendor/autoload.php';

try {
  $dotenv = new Dotenv\Dotenv(dirname(__DIR__, 2));
  $dotenv->load();
} catch (Exception $e) {
  echo "There was an error reading the /.env file. Copy it from /example.env.";
  echo "<hr>";
  echo $e->getMessage();
  die();
}

define('CONFIG', require 'config.php');

use Dawn\Session;
use Dawn\App\App;

$app = new App(CONFIG);

return $app->bootstrap();
