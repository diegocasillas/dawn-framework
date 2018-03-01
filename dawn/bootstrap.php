<?php

require 'global.php';
require 'Dawn/ServiceProvider.php';
require 'Dawn/App.php';
require 'Dawn/helpers.php';
require 'Dawn/Session.php';
require 'Dawn/Database/Connection.php';
require 'Dawn/Routing/Router.php';
require 'Dawn/Routing/Route.php';
require 'Dawn/Routing/Uri.php';
require 'Dawn/Routing/Request.php';
require 'Dawn/Routing/ControllerDispatcher.php';
require 'app/controllers/Controller.php';
require 'Dawn/Auth/Auth.php';
require 'Dawn/Auth/Middleware.php';
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
define('ROUTES', 'Dawn/routes.php');
define('ROUTES_API', 'Dawn/routesAPI.php');

$db = Connection::make(CONFIG['database']);











