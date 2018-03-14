<?php

namespace Dawn\Auth;

use Dawn\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerAuth();
    }

    private function registerAuth()
    {
        $auth = new Auth($this->app);
        $this->app->bind('auth', $auth);
    }
}