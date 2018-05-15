<?php

namespace Dawn\Session;

use Dawn\App\ServiceProvider;

/**
 * Registers and boots session services.
 */
class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSession();
    }

    /**
     * Bootstrap the services.
     *
     * @return void
     */
    public function boot()
    {
        $session = $this->app->get('session');
    }

    /**
     * Create a new Session instance and bind it to the application container.
     *
     * @return void
     */
    private function registerSession()
    {
        $session = new Session($this->app, $this->app->getConfig()['session']);
        $session->start();

        $this->app->bind('session', $session);
    }
}
