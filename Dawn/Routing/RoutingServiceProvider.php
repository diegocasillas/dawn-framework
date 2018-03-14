<?php

namespace Dawn\Routing;

use Dawn\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRouter();
    }

    private function registerRouter()
    {
        $router = new Router($this->app, CONFIG['routes']);
        $this->app->bind('router', $router);
    }
}