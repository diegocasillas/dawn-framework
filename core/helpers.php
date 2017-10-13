<?php

function view($name, $data = [])
{
    extract($data);
    return require "app/views/{$name}.view.php";
}
