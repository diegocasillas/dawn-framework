<?php

namespace Dawn\App;

/**
 * Interface to be implemented by service providers.
 */
interface ServiceProviderInterface
{
    /**
     * Bind a service to the application container.
     *
     * @return void
     */
    public function register();

    /**
     * Bootstrap the service.
     *
     * @return void
     */
    public function boot();
}