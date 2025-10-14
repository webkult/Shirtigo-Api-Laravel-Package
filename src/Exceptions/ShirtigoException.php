<?php

namespace LaravelShirtigo\Exceptions;

use Exception;

class ShirtigoException extends Exception
{
    protected int $statusCode;

    public function __construct(string $message = '', int $statusCode = 0, ?Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public static function apiError(string $message, int $statusCode = 500): self
    {
        return new self("Shirtigo API Error: {$message}", $statusCode);
    }

    public static function configurationError(string $message): self
    {
        return new self("Shirtigo Configuration Error: {$message}");
    }

    public static function authenticationError(string $message = 'Authentication failed'): self
    {
        return new self("Shirtigo Authentication Error: {$message}", 401);
    }

    public static function rateLimitExceeded(string $message = 'Rate limit exceeded'): self
    {
        return new self("Shirtigo Rate Limit Error: {$message}", 429);
    }
}