<?php

class Session
{
    public static function start()
    {
        session_start();

        if (!isset($_SESSION['USER'])) {
            $_SESSION['USER'] = new User();
        }

        var_dump($_SESSION);
        

        // if (!isset($_SESSION['DB'])) {
        //     $_SESSION['DB'] = Connection::make(CONFIG['database']);
        // }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function user()
    {
        return $_SESSION['USER'];
    }

    public static function db()
    {
        return $_SESSION['DB'];
    }
}