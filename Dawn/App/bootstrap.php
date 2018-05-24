<?php

if (file_exists('vendor/autoload.php')) {
  require 'vendor/autoload.php';
} else {
  $error = "There was an error reading the vendor/autoload.php file. Did you run 'composer install'?";
  require "app/views/errors/custom.view.php";
  die();
}


try {
  $dotenv = new Dotenv\Dotenv(dirname(__DIR__, 2));
  $dotenv->load();
} catch (Exception $e) {
  $error = "There was an error reading the /.env file. Copy it from /example.env.";

  view('errors/custom', compact('error'));
  die();
}

define('CONFIG', require 'config.php');

use Dawn\Session;
use Dawn\App\App;

$app = new App(CONFIG);

return $app->bootstrap();
