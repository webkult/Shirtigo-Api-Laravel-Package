<?php

namespace LaravelShirtigo\Services;

use LaravelShirtigo\Contracts\ShirtigoServiceInterface;
use LaravelShirtigo\Services\Api\OrderService;
use LaravelShirtigo\Services\Api\ProductService;
use LaravelShirtigo\Services\Api\DesignService;
use LaravelShirtigo\Services\Api\ImageService;
use LaravelShirtigo\Services\Api\UserService;
use LaravelShirtigo\Services\Api\CatalogService;
use LaravelShirtigo\Services\Api\BrandingService;
use LaravelShirtigo\Services\Api\WarehousingService;
use LaravelShirtigo\Services\Api\WebhookService;
use LaravelShirtigo\Services\Api\IntegrationService;
use LaravelShirtigo\Services\Api\ProjectService;
use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class ShirtigoService implements ShirtigoServiceInterface
{
    protected WebkultApiShirtigo $client;
    protected array $services = [];

    public function __construct()
    {
        $this->client = new WebkultApiShirtigo();
    }

    public function orders(): OrderService
    {
        return $this->getService(OrderService::class);
    }

    public function products(): ProductService
    {
        return $this->getService(ProductService::class);
    }

    public function designs(): DesignService
    {
        return $this->getService(DesignService::class);
    }

    public function images(): ImageService
    {
        return $this->getService(ImageService::class);
    }

    public function users(): UserService
    {
        return $this->getService(UserService::class);
    }

    public function catalog(): CatalogService
    {
        return $this->getService(CatalogService::class);
    }

    public function branding(): BrandingService
    {
        return $this->getService(BrandingService::class);
    }

    public function warehousing(): WarehousingService
    {
        return $this->getService(WarehousingService::class);
    }

    public function webhooks(): WebhookService
    {
        return $this->getService(WebhookService::class);
    }

    public function integrations(): IntegrationService
    {
        return $this->getService(IntegrationService::class);
    }

    public function projects(): ProjectService
    {
        return $this->getService(ProjectService::class);
    }

    protected function getService(string $serviceClass): object
    {
        if (!isset($this->services[$serviceClass])) {
            $this->services[$serviceClass] = new $serviceClass($this->client);
        }

        return $this->services[$serviceClass];
    }
}