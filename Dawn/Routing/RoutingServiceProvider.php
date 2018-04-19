<?php

namespace Dawn\Routing;

use Dawn\App\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerControllerDispatcher();
        $this->registerRouter();
    }

    public function boot()
    {

    }

    private function registerControllerDispatcher()
    {
        $controllerDispatcher = new ControllerDispatcher($this->app);
        $this->app->bind('controller dispatcher', $controllerDispatcher);
    }

    private function registerRouter()
    {
        $router = new Router($this->app, $this->app->getConfig()['routes']);

        $request = new Request();
        $router->setRequest($request);

        $controllerDispatcher = $this->app->get('controller dispatcher');
        $router->setControllerDispatcher($controllerDispatcher);

        $this->app->bind('router', $router);
    }
}