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
}

