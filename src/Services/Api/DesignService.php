<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class DesignService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAll(): array
    {
        $cacheKey = 'designs_all';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->designApi()->getAllDesigns();
            return $this->handleResponse($response);
        });
    }

    public function get(int $designId): array
    {
        $cacheKey = "design_{$designId}";

        return $this->executeWithCache($cacheKey, function () use ($designId) {
            $response = $this->client->designApi()->getDesign($designId);
            return $this->handleResponse($response);
        });
    }

    public function createFromFile(string $filePath, array $data = []): array
    {
        $response = $this->client->designApi()->createDesignFromFile();
        return $this->handleResponse($response);
    }

    public function createFromUrl(string $url, array $data = []): array
    {
        $response = $this->client->designApi()->createDesignFromUrl();
        return $this->handleResponse($response);
    }

    public function createFromBase64(string $base64Data, array $data = []): array
    {
        $response = $this->client->designApi()->createDesignFromBase64EncodedData();
        return $this->handleResponse($response);
    }

    public function update(int $designId, array $data): array
    {
        $response = $this->client->designApi()->updateDesign();
        return $this->handleResponse($response);
    }

    public function delete(int $designId): array
    {
        $response = $this->client->designApi()->deleteDesign();
        return $this->handleResponse($response);
    }
}