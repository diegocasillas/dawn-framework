<?php

require 'global.php';
require 'dawn/helpers.php';
require 'dawn/Session.php';
require 'dawn/Database/Connection.php';
require 'dawn/Routing/Router.php';
require 'dawn/Routing/Route.php';
require 'dawn/Routing/Uri.php';
require 'dawn/Routing/Request.php';
require 'dawn/Routing/ControllerDispatcher.php';
require 'app/controllers/Controller.php';
require 'dawn/Auth/Auth.php';
require 'dawn/Auth/Middleware.php';
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
define('ROUTES', 'dawn/routes.php');
define('ROUTES_API', 'dawn/routesAPI.php');

$db = Connection::make(CONFIG['database']);











