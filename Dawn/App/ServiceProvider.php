<?php

namespace Dawn\App;

abstract class ServiceProvider implements ServiceProviderInterface
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}