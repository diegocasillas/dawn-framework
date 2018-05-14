<?php

namespace Dawn\App;

/**
 * Class to be extended by different service providers.
 */
abstract class ServiceProvider implements ServiceProviderInterface
{
    /**
     * The application container instance.
     *
     * @var App
     */
    protected $app;

    /**
     * Create a new Service Provider instance.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }
}
