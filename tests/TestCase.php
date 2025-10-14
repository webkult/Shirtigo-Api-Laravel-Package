<?php

namespace LaravelShirtigo\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use LaravelShirtigo\Providers\ShirtigoServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ShirtigoServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('shirtigo.api_key', 'test-api-key');
        $app['config']->set('shirtigo.base_url', 'https://test.shirtigo.com/api/');
        $app['config']->set('shirtigo.cache.enabled', false);
        $app['config']->set('shirtigo.logging.enabled', false);
    }
}