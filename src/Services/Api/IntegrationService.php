<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class IntegrationService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getUserIntegration(): array
    {
        $cacheKey = 'integration_user';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->integrationApi()->getUserIntegration();
            return $this->handleResponse($response);
        });
    }

    public function updateUserIntegration(array $data): array
    {
        $response = $this->client->integrationApi()->updateUserIntegration();
        return $this->handleResponse($response);
    }

    public function deleteUserIntegration(): array
    {
        $response = $this->client->integrationApi()->deleteUserIntegration();
        return $this->handleResponse($response);
    }

    public function translateSyncError(string $errorCode): array
    {
        $cacheKey = "integration_error_{$errorCode}";

        return $this->executeWithCache($cacheKey, function () use ($errorCode) {
            $response = $this->client->integrationApi()->translateUserIntegrationSyncError($errorCode);
            return $this->handleResponse($response);
        });
    }
}