<?php

require 'core/helpers.php';
require 'core/database/Connection.php';
require 'core/Router.php';
require 'core/Request.php';
require 'app/controllers/PostController.php';
require 'app/models/Model.php';
require 'app/models/Comment.php';
require 'app/models/Post.php';
require 'global.php';
$config = require 'config.php';
// $routes = require 'core/Routes.php';
$db = Connection::make($config['database']);




