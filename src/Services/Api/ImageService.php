<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class ImageService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function generateMedia(array $data): array
    {
        $response = $this->client->imageApi()->generateMedia();
        return $this->handleResponse($response);
    }

    public function generateMockupImages(array $data): array
    {
        $response = $this->client->imageApi()->generateMockupImages();
        return $this->handleResponse($response);
    }

    public function getGeneratedMediaDetails(int $mediaId): array
    {
        $cacheKey = "generated_media_{$mediaId}";

        return $this->executeWithCache($cacheKey, function () use ($mediaId) {
            $response = $this->client->imageApi()->getGeneratedMediaDetails($mediaId);
            return $this->handleResponse($response);
        });
    }

    public function getGeneratedMediaList(): array
    {
        $cacheKey = 'generated_media_list';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->imageApi()->getGeneratedMediaList();
            return $this->handleResponse($response);
        });
    }

    public function getMediaStyles(): array
    {
        $cacheKey = 'media_styles';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->imageApi()->getMediaStyles();
            return $this->handleResponse($response);
        });
    }

    public function getRenderingTaskByReference(string $reference): array
    {
        $cacheKey = "rendering_task_{$reference}";

        return $this->executeWithCache($cacheKey, function () use ($reference) {
            $response = $this->client->imageApi()->getRenderingTaskByReference($reference);
            return $this->handleResponse($response);
        });
    }

    public function getRenderingTasks(): array
    {
        $cacheKey = 'rendering_tasks';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->imageApi()->getRenderingTasks();
            return $this->handleResponse($response);
        });
    }

    public function removeBackground(array $data): array
    {
        $response = $this->client->imageApi()->removeBackground();
        return $this->handleResponse($response);
    }

    public function upscaleDesign(array $data): array
    {
        $response = $this->client->imageApi()->upscaleDesign();
        return $this->handleResponse($response);
    }

    public function upscaleVariation(array $data): array
    {
        $response = $this->client->imageApi()->upscaleVariation();
        return $this->handleResponse($response);
    }
}