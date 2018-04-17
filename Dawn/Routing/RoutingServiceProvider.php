<?php

namespace Dawn\Routing;

use Dawn\App\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRouter();
    }

    public function boot()
    {

    }

    private function registerRouter()
    {
        $router = new Router($this->app);
        $this->app->bind('router', $router);
    }
}