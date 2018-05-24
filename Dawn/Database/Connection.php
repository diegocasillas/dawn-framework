<?php

namespace Dawn\Database;

use PDO;
use Dawn\App\App;

/**
 * Creates a PDO connection to the database.
 */
class Connection extends PDO
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    private $app;

    /**
     * Configuration array.
     *
     * @var array
     */
    private $config = [];

    /**
     * Create a new Connection instance.
     *
     * @param [type] $app
     * @param [type] $config
     */
    public function __construct(App $app, array $config)
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
            $error = "Could not connect to the database. Check the credentials in the '/.env' file and make sure that the database server is running.";
            view('errors/custom', compact('error'));
            die();
        }
    }
}
