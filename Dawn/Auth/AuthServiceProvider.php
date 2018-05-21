<?php

namespace Dawn\Auth;

use Dawn\App\ServiceProvider;
use Dawn\Session;

/**
 * Registers and boots authentication and authorization services.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAuth();
    }

    /**
     * Bootstrap the services.
     *
     * @return void
     */
    public function boot()
    {
        $this->prepareRequest();
        $this->prepareUser();
    }

    /**
     * Create a new Auth instance and bind it to the application container.
     *
     * @return void
     */
    private function registerAuth()
    {
        $auth = new Auth($this->app);
        $this->app->bind('auth', $auth);
    }

    /**
     * Set the current token and user from the session service.
     *
     * @return void
     */
    private function prepareUser()
    {
        $token = $this->app->get('session')->getToken();
        $auth = $this->app->get('auth');
        $auth->setToken($token);
        $auth->setDecodedToken($auth->decodeToken($token));
        $auth->findUser($token);
    }

    /**
     * Set the current request from the router service.
     *
     * @return void
     */
    private function prepareRequest()
    {
        $auth = $this->app->get('auth');
        $request = $this->app->get('router')->getRequest();
        $auth->setRequest($request);
    }
}
