<?php

namespace LaravelShirtigo\Exceptions;

use LaravelShirtigo\Exceptions\ShirtigoException;

class ApiException extends ShirtigoException
{
    protected array $response;

    public function __construct(string $message = '', int $statusCode = 0, array $response = [], ?\Exception $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->response = $response;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public static function fromResponse(array $response, int $statusCode): self
    {
        $message = $response['message'] ?? 'API request failed';
        $error = $response['error'] ?? null;

        if ($error) {
            $message .= ': ' . (is_string($error) ? $error : json_encode($error));
        }

        return new self($message, $statusCode, $response);
    }
}