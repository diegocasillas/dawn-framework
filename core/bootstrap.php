<?php

require 'core/helpers.php';
require 'core/Session.php';
require 'core/database/Connection.php';
require 'core/Router.php';
require 'core/Route.php';
require 'core/Request.php';
require 'core/Auth/Auth.php';
require 'core/Auth/User.php';
require 'app/controllers/LoginController.php';
require 'app/controllers/PostController.php';
require 'app/controllers/CommentController.php';
require 'app/models/Model.php';
require 'app/models/Post.php';
require 'app/models/Comment.php';
require 'global.php';
$config = require 'config.php';

Session::start();
$db = Connection::make($config['database']);




