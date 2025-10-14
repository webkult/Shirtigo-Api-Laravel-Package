<?php

namespace LaravelShirtigo\Tests\Unit\Services;

use LaravelShirtigo\Services\ShirtigoService;
use LaravelShirtigo\Tests\TestCase;
use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class ShirtigoServiceTest extends TestCase
{
    public function test_can_create_service(): void
    {
        $service = new ShirtigoService();
        
        $this->assertInstanceOf(ShirtigoService::class, $service);
    }

    public function test_can_get_orders_service(): void
    {
        $service = new ShirtigoService();
        
        $ordersService = $service->orders();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\OrderService::class, $ordersService);
    }

    public function test_can_get_products_service(): void
    {
        $service = new ShirtigoService();
        
        $productsService = $service->products();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\ProductService::class, $productsService);
    }

    public function test_can_get_designs_service(): void
    {
        $service = new ShirtigoService();
        
        $designsService = $service->designs();
        
        $this->assertInstanceOf(\LaravelShirtigo\Services\Api\DesignService::class, $designsService);
    }

    public function test_services_are_singleton(): void
    {
        $service = new ShirtigoService();
        
        $ordersService1 = $service->orders();
        $ordersService2 = $service->orders();
        
        $this->assertSame($ordersService1, $ordersService2);
    }
}