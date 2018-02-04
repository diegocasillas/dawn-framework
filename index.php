<?php

require 'core/bootstrap.php';

Session::start();

Router::start()->getRequest()->processRequest()->direct();