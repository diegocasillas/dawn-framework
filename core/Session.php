<?php

class Session
{
    public static function start()
    {
        session_start();

        if (!isset($_SESSION['USER'])) {
            $_SESSION['USER'] = new User();
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function user()
    {
        return $_SESSION['USER'];
    }
}