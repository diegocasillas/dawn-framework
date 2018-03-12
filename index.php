<?php

require 'dawn/bootstrap.php';

$app = new Dawn\App('Dawn', __DIR__);
$app->bootstrap();
$app->run();