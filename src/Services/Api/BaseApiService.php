<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;
use LaravelShirtigo\Exceptions\ShirtigoException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

abstract class BaseApiService
{
    protected WebkultApiShirtigo $client;
    protected string $cachePrefix;
    protected int $cacheTtl;
    protected bool $cacheEnabled;
    protected bool $loggingEnabled;

    public function __construct(WebkultApiShirtigo $client)
    {
        $this->client = $client;
        $this->cachePrefix = config('shirtigo.cache.prefix', 'shirtigo_');
        $this->cacheTtl = config('shirtigo.cache.ttl', 3600);
        $this->cacheEnabled = config('shirtigo.cache.enabled', true);
        $this->loggingEnabled = config('shirtigo.logging.enabled', true);
    }

    protected function executeWithCache(string $cacheKey, callable $callback, ?int $ttl = null)
    {
        if (!$this->cacheEnabled) {
            return $this->executeWithRetry($callback);
        }

        return Cache::remember(
            $this->cachePrefix . $cacheKey,
            $ttl ?? $this->cacheTtl,
            fn() => $this->executeWithRetry($callback)
        );
    }

    protected function executeWithRetry(callable $callback)
    {
        $attempts = config('shirtigo.retry.attempts', 3);
        $delay = config('shirtigo.retry.delay', 1000);

        for ($i = 0; $i < $attempts; $i++) {
            try {
                $response = $callback();

                if ($this->loggingEnabled) {
                    Log::channel(config('shirtigo.logging.channel', 'default'))
                        ->info('Shirtigo API call successful', [
                            'service' => static::class,
                            'attempt' => $i + 1,
                        ]);
                }

                return $response;
            } catch (\Exception $e) {
                if ($i === $attempts - 1) {
                    if ($this->loggingEnabled) {
                        Log::channel(config('shirtigo.logging.channel', 'default'))
                            ->error('Shirtigo API call failed after all retries', [
                                'service' => static::class,
                                'attempts' => $attempts,
                                'error' => $e->getMessage(),
                            ]);
                    }

                    throw new ShirtigoException(
                        'API call failed after ' . $attempts . ' attempts: ' . $e->getMessage(),
                        0,
                        $e
                    );
                }

                if ($this->loggingEnabled) {
                    Log::channel(config('shirtigo.logging.channel', 'default'))
                        ->warning('Shirtigo API call failed, retrying', [
                            'service' => static::class,
                            'attempt' => $i + 1,
                            'error' => $e->getMessage(),
                        ]);
                }

                usleep($delay * 1000);
            }
        }
    }

    protected function handleResponse($response)
    {
        if (!$response->successful()) {
            throw new ShirtigoException(
                'API request failed with status ' . $response->status() . ': ' . $response->body(),
                $response->status()
            );
        }

        return $response->json();
    }
}
