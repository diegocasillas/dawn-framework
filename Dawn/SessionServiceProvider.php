<?php

namespace Dawn;

use Dawn\App\ServiceProvider;
use Dawn\Session;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerSession();
    }

    private function registerSession()
    {
        $session = new Session($this->app);
        $this->app->bind('session', $session);
    }

    public function boot()
    {
        $session = $this->app->get('session');
        $session->start();
    }
}