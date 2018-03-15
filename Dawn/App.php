<?php

namespace Dawn;

class App
{
    protected $basePath;
    protected $serviceProviders = [];

    public function __construct(string $basePath = null, array $config)
    {
        $this->basePath = $basePath;
        $this->config = $config;
    }

    public function bootstrap()
    {
        $this->registerServiceProviders();

        return $this;
    }

    public function registerServiceProviders()
    {
        foreach ($this->config['service providers'] as $key => $serviceProviderClass) {
            $serviceProvider = (new $serviceProviderClass($this))->register();
        }
    }

    public function bootServiceProviders()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->boot();
        }
    }

    public function run()
    {
        $this->serviceProviders['router']->start();
    }

    public function bind(string $serviceProviderName, $serviceProvider)
    {
        if (empty($serviceProviderName)) {
            return null;
        }

        $this->serviceProviders[$serviceProviderName] = $serviceProvider;

        return $this->serviceProviders[$serviceProviderName];
    }

    public function get(string $serviceProviderName)
    {
        return $this->serviceProviders[$serviceProviderName];
    }

    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }

    public function setServiceProviders(array $serviceProviders)
    {
        foreach ($serviceProviders as $key => $value) {
            if (empty($key) || !is_object($value)) {
                return false;
            }
        }

        $this->serviceProviders = $serviceProviders;

        return $this->serviceProviders;
    }
}