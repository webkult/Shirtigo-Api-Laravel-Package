<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class BrandingService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getUserPackings(): array
    {
        $cacheKey = 'branding_user_packings';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->brandingApi()->getUserPackings();
            return $this->handleResponse($response);
        });
    }

    public function getSingleUserPackin(int $packinId): array
    {
        $cacheKey = "branding_user_packin_{$packinId}";

        return $this->executeWithCache($cacheKey, function () use ($packinId) {
            $response = $this->client->brandingApi()->getSingleUserPackin($packinId);
            return $this->handleResponse($response);
        });
    }

    public function createUserPackin(array $data): array
    {
        $response = $this->client->brandingApi()->createUserPackin();
        return $this->handleResponse($response);
    }

    public function updateUserPackin(int $packinId, array $data): array
    {
        $response = $this->client->brandingApi()->updateUserPackin();
        return $this->handleResponse($response);
    }

    public function deleteUserPackin(int $packinId): array
    {
        $response = $this->client->brandingApi()->deleteUserPackin();
        return $this->handleResponse($response);
    }

    public function getPackinPrices(): array
    {
        $cacheKey = 'branding_packin_prices';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->brandingApi()->getPackinPrices();
            return $this->handleResponse($response);
        });
    }

    public function uploadStickerLogo(array $data): array
    {
        $response = $this->client->brandingApi()->uploadStickerLogo();
        return $this->handleResponse($response);
    }

    public function deleteStickerLogo(): array
    {
        $response = $this->client->brandingApi()->deleteStickerLogo();
        return $this->handleResponse($response);
    }

    public function uploadDeliveryReceiptLogo(array $data): array
    {
        $response = $this->client->brandingApi()->uploadDeliveryReceiptLogo();
        return $this->handleResponse($response);
    }

    public function deleteDeliveryReceiptLogo(): array
    {
        $response = $this->client->brandingApi()->deleteDeliveryReceiptLogo();
        return $this->handleResponse($response);
    }
}