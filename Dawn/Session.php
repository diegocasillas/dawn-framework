<?php

namespace Dawn;

use \Firebase\JWT\JWT;

class Session
{
    public static function start()
    {
        session_start();

        if (!isset($_SESSION['USER'])) {
            $_SESSION['USER'] = null;
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function setUser($userId)
    {
        $_SESSION['USER'] = $userId;
    }

    public static function user()
    {
        if ($_SESSION['USER'] === null) {
            return null;
        }

        return JWT::decode($_SESSION['USER'], app()->getKey(), array('HS256'))->id;
    }
}