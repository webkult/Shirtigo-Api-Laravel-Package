<?php

namespace LaravelShirtigo\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelShirtigo\Contracts\ShirtigoServiceInterface;

/**
 * @method static \LaravelShirtigo\Services\Api\OrderService orders()
 * @method static \LaravelShirtigo\Services\Api\ProductService products()
 * @method static \LaravelShirtigo\Services\Api\DesignService designs()
 * @method static \LaravelShirtigo\Services\Api\ImageService images()
 * @method static \LaravelShirtigo\Services\Api\UserService users()
 * @method static \LaravelShirtigo\Services\Api\CatalogService catalog()
 * @method static \LaravelShirtigo\Services\Api\BrandingService branding()
 * @method static \LaravelShirtigo\Services\Api\WarehousingService warehousing()
 * @method static \LaravelShirtigo\Services\Api\WebhookService webhooks()
 * @method static \LaravelShirtigo\Services\Api\IntegrationService integrations()
 * @method static \LaravelShirtigo\Services\Api\ProjectService projects()
 */
class Shirtigo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ShirtigoServiceInterface::class;
    }
}