<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class UserService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getProfile(): array
    {
        $cacheKey = 'user_profile';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->userApi()->getUserProfile();
            return $this->handleResponse($response);
        });
    }

    public function updateProfile(array $data): array
    {
        $response = $this->client->userApi()->updateUserProfile();
        return $this->handleResponse($response);
    }

    public function getSettings(): array
    {
        $cacheKey = 'user_settings';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->userApi()->getUserSettings();
            return $this->handleResponse($response);
        });
    }

    public function updateSettings(array $data): array
    {
        $response = $this->client->userApi()->updateUserSettings();
        return $this->handleResponse($response);
    }
}