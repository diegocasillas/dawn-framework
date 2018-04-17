<?php

namespace Dawn\Database;

use PDO;

class Connection extends PDO
{
    private $app;
    private $config;

    public function __construct($app, $config)
    {
        try {
            parent::__construct(
                "mysql:host=" . $config['connection'] . ';dbname=' . $config['name'],
                $config['user'],
                $config['password']
            );

            $this->app = $app;
            $this->config = $config;
        } catch (\PDOException $e) {
            echo "Could not connect to the database. Check '/.env' file and make sure that the database server is running.";
            echo "<hr>";
            echo $e->getMessage();
            die();
        }
    }
}
