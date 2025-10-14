<?php

namespace LaravelShirtigo\Contracts;

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

interface ShirtigoServiceInterface
{
    public function orders(): OrderService;
    public function products(): ProductService;
    public function designs(): DesignService;
    public function images(): ImageService;
    public function users(): UserService;
    public function catalog(): CatalogService;
    public function branding(): BrandingService;
    public function warehousing(): WarehousingService;
    public function webhooks(): WebhookService;
    public function integrations(): IntegrationService;
    public function projects(): ProjectService;
}