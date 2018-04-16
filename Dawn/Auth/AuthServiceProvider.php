<?php

namespace Dawn\Auth;

use Dawn\App\ServiceProvider;
use Dawn\Session;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerAuth();
    }

    private function registerAuth()
    {
        $token = $this->app->get('session')->token();
        $auth = new Auth($this->app, $token);
        $this->app->bind('auth', $auth);
    }
}