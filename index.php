<?php

require 'dawn/bootstrap.php';

Session::start();

Router::start()->getRequest()->processRequest()->direct();