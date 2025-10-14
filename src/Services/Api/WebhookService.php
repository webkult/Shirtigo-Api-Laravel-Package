<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class WebhookService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAll(): array
    {
        $cacheKey = 'webhooks_all';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->webhookApi()->getAllWebhooks();
            return $this->handleResponse($response);
        });
    }

    public function get(int $webhookId): array
    {
        $cacheKey = "webhook_{$webhookId}";

        return $this->executeWithCache($cacheKey, function () use ($webhookId) {
            $response = $this->client->webhookApi()->getWebhook($webhookId);
            return $this->handleResponse($response);
        });
    }

    public function create(array $data): array
    {
        $response = $this->client->webhookApi()->createWebhook();
        return $this->handleResponse($response);
    }

    public function update(int $webhookId, array $data): array
    {
        $response = $this->client->webhookApi()->updateWebhook();
        return $this->handleResponse($response);
    }

    public function delete(int $webhookId): array
    {
        $response = $this->client->webhookApi()->deleteWebhook();
        return $this->handleResponse($response);
    }

    public function test(int $webhookId): array
    {
        $response = $this->client->webhookApi()->testWebhook();
        return $this->handleResponse($response);
    }
}