<?php

namespace Dawn;

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
        return $_SESSION['USER'];
    }
}