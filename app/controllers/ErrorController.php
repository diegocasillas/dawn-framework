<?php

class ErrorController
{
    public function error404()
    {
        return require 'app/views/errors/404.view.php';
    }
}