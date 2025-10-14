<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class ProjectService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAll(): array
    {
        $cacheKey = 'projects_all';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->projectApi()->getAllProjects();
            return $this->handleResponse($response);
        });
    }

    public function get(int $projectId): array
    {
        $cacheKey = "project_{$projectId}";

        return $this->executeWithCache($cacheKey, function () use ($projectId) {
            $response = $this->client->projectApi()->getProject($projectId);
            return $this->handleResponse($response);
        });
    }

    public function create(array $data): array
    {
        $response = $this->client->projectApi()->createProject();
        return $this->handleResponse($response);
    }

    public function update(int $projectId, array $data): array
    {
        $response = $this->client->projectApi()->updateProject();
        return $this->handleResponse($response);
    }

    public function delete(int $projectId): array
    {
        $response = $this->client->projectApi()->deleteProject();
        return $this->handleResponse($response);
    }
}