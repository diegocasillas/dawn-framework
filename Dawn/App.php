<?php

namespace Dawn;

class App
{
    protected $name;
    protected $basePath;
    protected $router;
    protected $serviceProviders = [];

    public function __construct(string $name = null, string $basePath = null)
    {
        $this->name = $name;
        $this->basePath = $basePath;
    }

    public function bootstrap()
    {
        $this->registerServiceProviders(SERVICE_PROVIDERS);

        return $this;
    }

    public function registerServiceProviders($serviceProviders)
    {
        foreach ($serviceProviders as $key => $serviceProviderClass) {
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

    public function bind(string $serviceProviderName, $service)
    {
        if (empty($serviceProviderName)) {
            return null;
        }

        $this->serviceProviders[$serviceProviderName] = $service;

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