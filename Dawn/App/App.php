<?php

namespace Dawn\App;

/**
 * Works as a container for the application. Prepares the services to be used and runs the application.
 */
class App
{
    /**
     * The name of the application.
     *
     * @var string
     */
    protected $appName;

    /**
     * Array that contains the configuration of the application.
     *
     * @var array
     */
    protected $config;

    /**
     * String used to encrypt data and generate JWT.
     *
     * @var string
     */
    protected $key;

    /**
     * Full path to the root of the application.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Array that contains instances of the classes that load the services.
     *
     * @var array
     */
    protected $serviceProviders = [];

    /**
     * Array that contains instances of loaded services.
     *
     * @var array
     */
    protected $services = [];

    /**
     * Current controller that is handling the request.
     *
     * @var Dawn\Routing\Controller
     */
    protected $controller;

    /**
     * Instance of Response that contains the token as data.
     *
     * @var Dawn\Routing\Response
     */
    protected $tokenResponse;

    /**
     * Create new App instance.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->appName = $config['app name'];
        $this->key = $config['key'];
        $this->basePath = $config['base'];
    }

    /**
     * Prepare the application.
     *
     * @return $this
     */
    public function bootstrap()
    {
        $this->loadServiceProviders();
        $this->registerServices();
        $this->bootServices();

        return $this;
    }

    /**
     * Load the service providers from the config.
     *
     * @return void
     */
    public function loadServiceProviders()
    {
        foreach ($this->config['service providers'] as $key => $serviceProvider) {
            $this->serviceProviders[$key] = new $serviceProvider($this);
        }
    }

    /**
     * Call the register method of each loaded service provider.
     *
     * @return void
     */
    public function registerServices()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider = (new $serviceProvider($this))->register();
        }
    }

    /**
     * Call the boot method of each loaded service provider.
     *
     * @return void
     */
    public function bootServices()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->boot();
        }
    }

    /**
     * Start the router.
     *
     * @return void
     */
    public function run()
    {
        if (array_key_exists('router', $this->services)) {
            $this->get('router')->start();
        }
    }

    /**
     * Bind a service to the application.
     *
     * @param string $serviceName
     * @param object $service
     * @return mixed
     */
    public function bind(string $serviceName, $service)
    {
        if (empty($serviceName)) {
            return null;
        }

        $this->services[$serviceName] = $service;

        return $this->services[$serviceName];
    }

    /**
     * Get a specific service.
     *
     * @param string $service
     * @return mixed
     */
    public function get(string $service)
    {
        if (array_key_exists($service, $this->services)) {
            return $this->services[$service];
        }
    }

    /**
     * Return the connection service.
     *
     * @return mixed
     */
    public function connection()
    {
        return $this->get('connection');
    }

    /**
     * Get the application name.
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Set the application name.
     *
     * @param string $appName
     * @return void
     */
    public function setAppName(string $appName)
    {
        $this->appName = $appName;
    }

    /**
     * Get the configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the configuration array.
     *
     * @param array $config
     * @return void
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get the base path of the application.
     *
     * @return void
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Set the base path of the application.
     *
     * @param string $basePath
     * @return void
     */
    public function setBasePath(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the application key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the application key.
     * 
     * @param string $key
     * @return void
     */
    public function setKey(string $key)
    {
        $this->key = $key;
    }

    /**
     * Get the service providers array.
     *
     * @return array
     */
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }

    /**
     * Set the service providers.
     *
     * @param array $serviceProviders
     * @return mixed
     */
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

    /**
     * Get the services array.
     *
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set the services array.
     *
     * @param array $services
     * @return void
     */
    public function setServices(array $services)
    {
        $this->services = $services;
    }

    /**
     * Get the controller.
     *
     * @return Dawn\Routing\Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the controller to handle the request.
     *
     * @param Dawn\Routing\Controller $controller
     * @return void
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Get the token response.
     *
     * @return Dawn\Routing\Response
     */
    public function getTokenResponse()
    {
        return $this->tokenResponse;
    }

    /**
     * Set the token response.
     *
     * @param Dawn\Routing\Response $tokenResponse
     * @return void
     */
    public function setTokenResponse(Dawn\Routing\Response $tokenResponse)
    {
        $this->tokenResponse = $tokenResponse;
    }
}