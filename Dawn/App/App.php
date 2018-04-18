<?php

namespace Dawn\App;

class App
{
    protected $appName;
    protected $config;
    protected $key;
    protected $basePath;
    protected $serviceProviders = [];
    protected $services = [];
    protected $controller;
    protected $tokenResponse;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->appName = $config['app name'];
        $this->key = $config['key'];
        $this->basePath = $config['base'];
    }

    public function bootstrap()
    {
        $this->loadServiceProviders();
        $this->registerServices();
        $this->bootServices();

        return $this;
    }

    public function loadServiceProviders()
    {
        foreach ($this->config['service providers'] as $key => $serviceProvider) {
            $this->serviceProviders[$key] = new $serviceProvider($this);
        }
    }

    public function registerServices()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider = (new $serviceProvider($this))->register();
        }
    }

    public function bootServices()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->boot();
        }
    }

    public function run()
    {
        if (array_key_exists('router', $this->services)) {
            $this->get('router')->start();
        }
    }

    public function bind(string $serviceName, $service)
    {
        if (empty($serviceName)) {
            return null;
        }

        $this->services[$serviceName] = $service;

        return $this->services[$serviceName];
    }

    public function get(string $service)
    {
        if (array_key_exists($service, $this->services)) {
            return $this->services[$service];
        }
    }

    public function connection()
    {
        return $this->get('connection');
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getKey()
    {
        return $this->key;
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

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }
}