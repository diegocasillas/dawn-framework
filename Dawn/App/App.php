<?php

namespace Dawn\App;

class App
{
    protected $appName;
    protected $config;
    protected $key;
    protected $basePath;
    protected $serviceProviders = [];
    protected $controller;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->appName = $config['app name'];
        $this->key = $config['key'];
        $this->basePath = $config['base'];
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

    public function cookie($key)
    {
        if (array_key_exists($key, $_COOKIE)) {
            return $_COOKIE[$key];
        }

        return null;
    }

    public function deleteCookie($key)
    {
        if (array_key_exists($key, $_COOKIE)) {
            setcookie($key, "");
            unset($_COOKIE[$key]);
        }
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