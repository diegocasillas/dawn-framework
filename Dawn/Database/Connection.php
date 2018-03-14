<?php

namespace Dawn\Database;

class Connection
{
    public static function make($config)
    {
        try {
            return new \PDO(
                "mysql:host=" . $config['connection'] . ';dbname=' . $config['name'],
                $config['user'],
                $config['password']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
