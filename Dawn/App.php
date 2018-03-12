<?php

namespace Dawn;

class App
{
    protected $name;
    protected $serviceProviders = [];

    public function __construct(string $name, string $basePath = null)
    {
        if (empty($name)) {
            throw new \Exception("The name can't be empty");
        }

        $this->name = $name;
        $this->basePath = $basePath;
    }

    public function bootstrap()
    {
        $this->bind('router', new Routing\Router([ROUTES, ROUTES_API]));

        return $this;
    }

    public function run()
    {
        $this->get('router')->start();
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