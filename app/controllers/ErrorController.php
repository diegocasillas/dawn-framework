<?php

namespace App\Controllers;

use Dawn\Routing\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        return require 'app/views/errors/404.view.php';
    }

    public function unauthorized()
    {
        return require 'app/views/errors/401.view.php';
    }

    public function custom()
    {
        return require 'app/views/errors/custom.view.php';
    }
}
