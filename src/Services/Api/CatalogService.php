<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class CatalogService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAllBaseProducts(): array
    {
        $cacheKey = 'catalog_base_products';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->catalogApi()->getAllBaseProducts();
            return $this->handleResponse($response);
        });
    }

    public function getBaseProduct(int $productId): array
    {
        $cacheKey = "catalog_base_product_{$productId}";

        return $this->executeWithCache($cacheKey, function () use ($productId) {
            $response = $this->client->catalogApi()->getBaseProduct($productId);
            return $this->handleResponse($response);
        });
    }

    public function getAvailableCategories(): array
    {
        $cacheKey = 'catalog_categories';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->catalogApi()->listAvailableCategories();
            return $this->handleResponse($response);
        });
    }
}