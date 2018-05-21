<?php

function dd($data, $pre = false)
{
    if ($pre) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    } else {
        var_dump($data);
    }

    die();
}

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
    header("Location: /{$path}");
}
