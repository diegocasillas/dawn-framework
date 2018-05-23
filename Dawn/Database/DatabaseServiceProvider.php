<?php

namespace Dawn\Database;

use Dawn\App\ServiceProvider;
use Dawn\Database\Connection;
use PHPUnit\Framework\MockObject\Stub\Exception;

/**
 * Registers and boots database services.
 */
class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConnection();
        $this->registerQueryBuilder();
    }

    /**
     * Create a new Connection instance and bind it to the application container.
     *
     * @return void
     */
    private function registerConnection()
    {
        $connection = new Connection($this->app, $this->app->getConfig()['database']);
        $this->app->bind('connection', $connection);
    }

    /**
     * Create a new Query Builder instance and bind it to the application container.
     *
     * @return void
     */
    private function registerQueryBuilder()
    {
        $this->app->bind('query builder', new QueryBuilder($this->app, $this->app->get('connection')));
    }

    /**
     * Bootstrap the services.
     *
     * @return void
     */
    public function boot()
    {
        $createTable = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `email` VARCHAR(50) NOT NULL,
                `username` VARCHAR(50) NOT NULL,
                `password` VARCHAR(60) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE INDEX `id` (`id`),
                UNIQUE INDEX `email` (`email`),
                UNIQUE INDEX `username` (`username`)
            )
        ";

        $this->app->get('query builder')->exec($createTable);
    }
}
