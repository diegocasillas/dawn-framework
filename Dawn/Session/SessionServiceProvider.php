<?php

namespace Dawn\Session;

use Dawn\App\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerSession();
    }

    public function boot()
    {
        $session = $this->app->get('session');
    }

    private function registerSession()
    {
        $session = new Session($this->app, $this->app->getConfig()['session']);
        $session->start();

        $this->app->bind('session', $session);
    }
}