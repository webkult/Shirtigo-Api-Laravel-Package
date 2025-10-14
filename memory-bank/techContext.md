# Technical Context: Laravel Shirtigo Wrapper

## Technologie-Stack

### Core Dependencies
- **PHP**: 8.1+ (Laravel 10+ Requirement)
- **Laravel**: 10+ (LTS Support)
- **Shirtigo SDK**: webkult/shirtigo-php-api-wrapper
- **Saloon**: ^3.0 (HTTP Client)

### Development Dependencies
- **PHPUnit**: Testing
- **Pest**: Alternative Testing
- **Rector**: Code Quality
- **PHP CS Fixer**: Code Style

## Projektstruktur

```
laravel-shirtigo-wrapper/
├── src/
│   ├── Services/
│   │   ├── ShirtigoService.php
│   │   └── Api/
│   │       ├── OrderService.php
│   │       ├── ProductService.php
│   │       └── DesignService.php
│   ├── Models/
│   │   ├── Order.php
│   │   ├── Product.php
│   │   └── Design.php
│   ├── Facades/
│   │   └── Shirtigo.php
│   ├── Commands/
│   │   ├── SyncProductsCommand.php
│   │   └── SyncOrdersCommand.php
│   ├── Providers/
│   │   └── ShirtigoServiceProvider.php
│   └── Exceptions/
│       ├── ShirtigoException.php
│       └── ApiException.php
├── config/
│   └── shirtigo.php
├── tests/
│   ├── Unit/
│   ├── Feature/
│   └── TestCase.php
└── docs/
    ├── installation.md
    ├── configuration.md
    └── api-reference.md
```

## Konfiguration

### Environment Variables
```env
SHIRTIGO_API_KEY=your_api_key
SHIRTIGO_BASE_URL=https://cockpit.shirtigo.com/api/
SHIRTIGO_CACHE_TTL=3600
SHIRTIGO_RETRY_ATTEMPTS=3
```

### Config File
```php
// config/shirtigo.php
return [
    'api_key' => env('SHIRTIGO_API_KEY'),
    'base_url' => env('SHIRTIGO_BASE_URL', 'https://cockpit.shirtigo.com/api/'),
    'cache' => [
        'enabled' => env('SHIRTIGO_CACHE_ENABLED', true),
        'ttl' => env('SHIRTIGO_CACHE_TTL', 3600),
    ],
    'retry' => [
        'attempts' => env('SHIRTIGO_RETRY_ATTEMPTS', 3),
        'delay' => env('SHIRTIGO_RETRY_DELAY', 1000),
    ],
];
```

## API-Integration

### Service Provider Registration
```php
// ShirtigoServiceProvider.php
public function register()
{
    $this->app->singleton(ShirtigoService::class);
    $this->app->alias(ShirtigoService::class, 'shirtigo');
}
```

### Facade Definition
```php
// Shirtigo.php
class Shirtigo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shirtigo';
    }
}
```

## Testing Strategy
- Unit Tests für Services
- Feature Tests für API-Integration
- Mock-Tests für externe API-Calls
- Integration Tests mit Test-API