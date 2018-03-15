<?php

function connection()
{
    global $app;
    return $app->connection();
}

function view($name, $data = [])
{
    extract($data);
    return require "app/views/{$name}.view.php";
}

function redirect($path = '')
{
    header("Location: /miniframework/{$path}");
}
