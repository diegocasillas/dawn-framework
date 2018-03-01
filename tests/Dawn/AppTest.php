<?php

declare (strict_types = 1);

use PHPUnit\Framework\TestCase;
use \Exception;
use Dawn\App;
use Dawn\ServiceProvider;


final class AppTest extends TestCase
{
    public function testExceptionIfEmptyName()
    {
        $this->expectException(Exception::class);
        new App('');
    }

    public function testCorrectInstanceIfNotEmptyName()
    {
        $this->assertInstanceOf(App::class, new App('test'));
    }

    public function testBindReturnsNullIfEmptyServiceProviderName()
    {
        $app = new App('test');
        $serviceProvider = $this->createMock(ServiceProvider::class);

        $this->assertNull($app->bind('', $serviceProvider));
    }

    public function testBindReturnsServiceProvider()
    {
        $app = new App('test');
        $serviceProvider = $this->createMock(ServiceProvider::class);

        $this->assertInstanceOf(
            ServiceProvider::class,
            $app->bind('SERVICE_PROVIDER', $serviceProvider)
        );
    }

    public function testGetServiceProvidersReturnsEmptyArray()
    {
        $app = new App('test');

        $this->assertEmpty($app->getServiceProviders());
    }

    public function testGetServiceProvidersReturnsNotEmptyArray()
    {
        $app = new App('test');
        $serviceProvider = $this->createMock(ServiceProvider::class);
        $app->bind('SERVICE_PROVIDER', $serviceProvider);

        $this->assertArraySubset(
            ['SERVICE_PROVIDER' => $serviceProvider],
            $app->getServiceProviders()
        );
    }

    public function testSetServiceProvidersWorks()
    {
        $app = new App('test');
        $serviceProviders = [
            'SERVICE_PROVIDER' => $this->createMock(ServiceProvider::class),
            'SERVICE_PROVIDER_2' => $this->createMock(ServiceProvider::class),
            'SERVICE_PROVIDER_3' => $this->createMock(ServiceProvider::class),
        ];

        $this->assertSame($serviceProviders, $app->setServiceProviders($serviceProviders));
    }

    public function testSetServiceProviderReturnsFalseIfEmptyKey()
    {
        $app = new App('test');
        $serviceProviders = [
            'SERVICE_PROVIDER' => $this->createMock(ServiceProvider::class),
            '' => $this->createMock(ServiceProvider::class),
            'SERVICE_PROVIDER_3' => $this->createMock(ServiceProvider::class),
        ];

        $this->assertFalse($app->setServiceProviders($serviceProviders));
    }

    public function testSetServiceProviderReturnsFalseIfValueIsNotObject()
    {
        $app = new App('test');
        $serviceProviders = [
            'SERVICE_PROVIDER' => $this->createMock(ServiceProvider::class),
            'SERVICE_PROVIDER_2' => "I'm not an object",
            'SERVICE_PROVIDER_3' => $this->createMock(ServiceProvider::class),
        ];

        $this->assertFalse($app->setServiceProviders($serviceProviders));
    }
}

