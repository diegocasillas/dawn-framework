<?php

namespace Dawn\Database;

use PDO;

class Connection
{
    private $app;
    private $config;

    public function __construct($app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function make()
    {
        try {
            return new PDO(
                "mysql:host=" . $this->config['connection'] . ';dbname=' . $this->config['name'],
                $this->config['user'],
                $this->config['password']
            );
        } catch (PDOException $e) {
            die("Couldn't connect to the database");
        }
    }
}
