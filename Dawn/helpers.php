<?php

function app()
{
    global $app;
    return $app;
}

function auth()
{
    global $app;
    return $app->get('auth');
}

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
