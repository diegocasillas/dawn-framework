<?php

namespace Dawn\Database;

use Dawn\ServiceProvider;
use Dawn\Database\Connection;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConnection();
    }

    private function registerConnection()
    {
        $connection = new Connection($this->app);
        $connection = $connection->make();
        $this->app->bind('connection', $connection);
    }
}