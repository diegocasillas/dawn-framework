<?php

require 'vendor/autoload.php';

use Dawn\Session;
use Dawn\App;

Session::start();

$app = new App('Dawn', __DIR__);

return $app->bootstrap();