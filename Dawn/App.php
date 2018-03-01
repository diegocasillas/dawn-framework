<?php

namespace Dawn;

class App
{
    protected $name;
    protected $serviceProviders = [];

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new \Exception("The name can't be empty");
        }

        $this->name = $name;
    }

    public function bind(string $serviceProviderName, $serviceProvider)
    {
        if (empty($serviceProviderName)) {
            return null;
        }

        $this->serviceProviders[$serviceProviderName] = $serviceProvider;

        return $this->serviceProviders[$serviceProviderName];
    }

    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }

    public function setServiceProviders(array $serviceProviders)
    {
    }
}