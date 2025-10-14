<?php

namespace LaravelShirtigo\Tests\Feature;

use LaravelShirtigo\Facades\Shirtigo;
use LaravelShirtigo\Tests\TestCase;

class FacadeTest extends TestCase
{
    public function test_can_access_orders_through_facade(): void
    {
        $ordersService = Shirtigo::orders();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\OrderService::class, $ordersService);
    }

    public function test_can_access_products_through_facade(): void
    {
        $productsService = Shirtigo::products();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\ProductService::class, $productsService);
    }

    public function test_can_access_designs_through_facade(): void
    {
        $designsService = Shirtigo::designs();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\DesignService::class, $designsService);
    }

    public function test_can_access_images_through_facade(): void
    {
        $imagesService = Shirtigo::images();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\ImageService::class, $imagesService);
    }

    public function test_can_access_users_through_facade(): void
    {
        $usersService = Shirtigo::users();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\UserService::class, $usersService);
    }

    public function test_can_access_catalog_through_facade(): void
    {
        $catalogService = Shirtigo::catalog();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\CatalogService::class, $catalogService);
    }

    public function test_can_access_branding_through_facade(): void
    {
        $brandingService = Shirtigo::branding();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\BrandingService::class, $brandingService);
    }

    public function test_can_access_warehousing_through_facade(): void
    {
        $warehousingService = Shirtigo::warehousing();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\WarehousingService::class, $warehousingService);
    }

    public function test_can_access_webhooks_through_facade(): void
    {
        $webhooksService = Shirtigo::webhooks();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\WebhookService::class, $webhooksService);
    }

    public function test_can_access_integrations_through_facade(): void
    {
        $integrationsService = Shirtigo::integrations();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\IntegrationService::class, $integrationsService);
    }

    public function test_can_access_projects_through_facade(): void
    {
        $projectsService = Shirtigo::projects();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\ProjectService::class, $projectsService);
    }
}