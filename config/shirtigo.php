<?php

return [
    'api_key' => env('SHIRTIGO_API_KEY'),
    'base_url' => env('SHIRTIGO_BASE_URL', 'https://cockpit.shirtigo.com/api/'),
    
    'cache' => [
        'enabled' => env('SHIRTIGO_CACHE_ENABLED', true),
        'ttl' => env('SHIRTIGO_CACHE_TTL', 3600),
        'prefix' => 'shirtigo_',
    ],
    
    'retry' => [
        'attempts' => env('SHIRTIGO_RETRY_ATTEMPTS', 3),
        'delay' => env('SHIRTIGO_RETRY_DELAY', 1000),
    ],
    
    'timeout' => [
        'connect' => env('SHIRTIGO_CONNECT_TIMEOUT', 30),
        'read' => env('SHIRTIGO_READ_TIMEOUT', 60),
    ],
    
    'logging' => [
        'enabled' => env('SHIRTIGO_LOGGING_ENABLED', true),
        'channel' => env('SHIRTIGO_LOG_CHANNEL', 'default'),
    ],
];