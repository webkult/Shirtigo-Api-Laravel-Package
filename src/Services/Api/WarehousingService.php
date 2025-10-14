<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class WarehousingService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getInventory(): array
    {
        $cacheKey = 'warehousing_inventory';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->warehousingApi()->getInventory();
            return $this->handleResponse($response);
        });
    }

    public function updateInventory(array $data): array
    {
        $response = $this->client->warehousingApi()->updateInventory();
        return $this->handleResponse($response);
    }

    public function getStockLevels(): array
    {
        $cacheKey = 'warehousing_stock_levels';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->warehousingApi()->getStockLevels();
            return $this->handleResponse($response);
        });
    }

    public function getFulfillmentCenters(): array
    {
        $cacheKey = 'warehousing_fulfillment_centers';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->warehousingApi()->getFulfillmentCenters();
            return $this->handleResponse($response);
        });
    }
}