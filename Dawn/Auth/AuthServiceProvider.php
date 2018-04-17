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
        $auth = new Auth($this->app);
        $this->app->bind('auth', $auth);
    }

    public function boot()
    {
        $token = $this->app->get('session')->token();
        $auth = $this->app->get('auth');
        $auth->setToken($token);
        $auth->findUser($token);
    }
}