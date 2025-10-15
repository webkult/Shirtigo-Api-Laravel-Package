<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class ProductService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAll(): array
    {
        $cacheKey = 'products_all';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->productApi()->getAllProducts();
            return $this->handleResponse($response);
        });
    }

    public function get(int $productId): array
    {
        $cacheKey = "product_{$productId}";

        return $this->executeWithCache($cacheKey, function () use ($productId) {
            $response = $this->client->productApi()->getProduct($productId);
            return $this->handleResponse($response);
        });
    }

    public function create(array $data): array
    {
        $response = $this->client->productApi()->createProduct();
        return $this->handleResponse($response);
    }

    public function update(int $productId, array $data): array
    {
        $response = $this->client->productApi()->updateProduct();
        return $this->handleResponse($response);
    }

    public function delete(int $productId): array
    {
        $response = $this->client->productApi()->deleteProduct();
        return $this->handleResponse($response);
    }

    public function updateColors(int $productId, array $colors): array
    {
        $response = $this->client->productApi()->updateProductColors();
        return $this->handleResponse($response);
    }

    public function updateMockups(int $productId, array $mockups): array
    {
        $response = $this->client->productApi()->updateProductMockups();
        return $this->handleResponse($response);
    }

    public function addImageForColor(int $productId, int $colorId, string $imageUrl): array
    {
        $response = $this->client->productApi()->addImageForProductColor();
        return $this->handleResponse($response);
    }

    public function synchronizeIntegrations(int $productId): array
    {
        $response = $this->client->productApi()->synchronizeIntegrations();
        return $this->handleResponse($response);
    }

    public function synchronizeProductImages(int $productId): array
    {
        $response = $this->client->productApi()->synchronizeOnlyProductImages();
        return $this->handleResponse($response);
    }
}
