<?php

namespace Dawn\Routing;

use Dawn\App\ServiceProvider;

/**
 * Registers and boots routing services.
 */
class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerControllerDispatcher();
        $this->registerRouter();
    }

    /**
     * Bootstrap the services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Create a new Controller Dispatcher instance and bind it to the application container.
     *
     * @return void
     */
    private function registerControllerDispatcher()
    {
        $controllerDispatcher = new ControllerDispatcher($this->app);
        $this->app->bind('controller dispatcher', $controllerDispatcher);
    }

    /**
     * Create a new Router instance and bind it to the application container.
     *
     * @return void
     */
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
