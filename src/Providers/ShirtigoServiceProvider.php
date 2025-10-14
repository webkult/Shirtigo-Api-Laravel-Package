<?php

namespace LaravelShirtigo\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelShirtigo\Services\ShirtigoService;
use LaravelShirtigo\Contracts\ShirtigoServiceInterface;

class ShirtigoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/shirtigo.php',
            'shirtigo'
        );

        $this->app->singleton(ShirtigoServiceInterface::class, ShirtigoService::class);
        $this->app->alias(ShirtigoServiceInterface::class, 'shirtigo');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/shirtigo.php' => config_path('shirtigo.php'),
            ], 'shirtigo-config');

            $this->publishes([
                __DIR__ . '/../../config/shirtigo.php' => config_path('shirtigo.php'),
            ], 'config');

            $this->commands([
                \LaravelShirtigo\Commands\SyncProductsCommand::class,
                \LaravelShirtigo\Commands\SyncOrdersCommand::class,
            ]);
        }
    }
}