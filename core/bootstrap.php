<?php

require 'global.php';
require 'core/helpers.php';
require 'core/Session.php';
require 'core/Database/Connection.php';
require 'core/Routing/Router.php';
require 'core/Routing/Route.php';
require 'core/Routing/Uri.php';
require 'core/Routing/Request.php';
require 'core/Routing/ControllerDispatcher.php';
require 'app/controllers/Controller.php';
require 'core/Auth/Auth.php';
require 'app/controllers/ErrorController.php';
require 'app/controllers/LoginController.php';
require 'app/controllers/RegisterController.php';
require 'app/controllers/PostController.php';
require 'app/controllers/CommentController.php';
require 'app/models/Model.php';
require 'app/models/User.php';
require 'app/models/Post.php';
require 'app/models/Comment.php';

define('CONFIG', require 'config.php');
define('ROUTES', 'core/routes.php');

$db = Connection::make(CONFIG['database']);











