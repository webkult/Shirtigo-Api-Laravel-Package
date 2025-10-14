# Laravel Shirtigo Wrapper

A Laravel wrapper for the Shirtigo PHP API SDK that simplifies the integration of Shirtigo services into Laravel applications.

## Installation

```bash
composer require laravel-shirtigo/wrapper
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=shirtigo-config
```

Configure your environment variables in the `.env` file:

```env
SHIRTIGO_API_KEY=your_api_key_here
SHIRTIGO_BASE_URL=https://cockpit.shirtigo.com/api/
SHIRTIGO_CACHE_ENABLED=true
SHIRTIGO_CACHE_TTL=3600
SHIRTIGO_RETRY_ATTEMPTS=3
SHIRTIGO_LOGGING_ENABLED=true
```

## Usage

### Using the Facade

```php
use LaravelShirtigo\Facades\Shirtigo;

// Get all orders
$orders = Shirtigo::orders()->getAll();

// Get single order
$order = Shirtigo::orders()->get('ORDER-123');

// Get all products
$products = Shirtigo::products()->getAll();

// Create design
$design = Shirtigo::designs()->createFromFile('/path/to/design.png');
```

### Service Injection

```php
use LaravelShirtigo\Contracts\ShirtigoServiceInterface;

class OrderController extends Controller
{
    public function __construct(
        private ShirtigoServiceInterface $shirtigo
    ) {}

    public function index()
    {
        $orders = $this->shirtigo->orders()->getAll();
        return view('orders.index', compact('orders'));
    }
}
```

## API Services

### Order Service

```php
// Get all orders
$orders = Shirtigo::orders()->getAll(
    page: 1,
    filter: 1, // Status filter
    items: 50,
    search: 'search term'
);

// Create order
$order = Shirtigo::orders()->create([
    'customer' => [...],
    'products' => [...],
    'delivery_address' => [...]
]);

// Cancel order
Shirtigo::orders()->cancel('ORDER-123');

// Retry payment
Shirtigo::orders()->retryPayment('ORDER-123');
```

### Product Service

```php
// Get all products
$products = Shirtigo::products()->getAll();

// Create product
$product = Shirtigo::products()->create([
    'name' => 'T-Shirt',
    'description' => 'A cool T-Shirt',
    'base_product_id' => 123
]);

// Update product
Shirtigo::products()->update(123, [
    'name' => 'Updated Name'
]);
```

### Design Service

```php
// Create design from file
$design = Shirtigo::designs()->createFromFile('/path/to/design.png', [
    'name' => 'My Design'
]);

// Create design from URL
$design = Shirtigo::designs()->createFromUrl('https://example.com/design.png');

// Create design from Base64
$design = Shirtigo::designs()->createFromBase64($base64Data);
```

### Image Service

```php
// Generate mockup images
$mockups = Shirtigo::images()->generateMockupImages([
    'product_id' => 123,
    'design_id' => 456
]);

// Remove background
$result = Shirtigo::images()->removeBackground([
    'image_url' => 'https://example.com/image.png'
]);
```

## Models

The wrapper provides Eloquent-like models for API responses:

```php
use LaravelShirtigo\Models\Order;

$order = Order::fromArray($orderData);

echo $order->getReference();
echo $order->getTotalPrice();
echo $order->isPaid() ? 'Paid' : 'Not paid';

$products = $order->getProducts();
foreach ($products as $product) {
    echo $product->getQuantity() . 'x ' . $product->getColor();
}
```

## Artisan Commands

### Sync products

```bash
php artisan shirtigo:sync-products --limit=100 --force
```

### Sync orders

```bash
php artisan shirtigo:sync-orders --status=1 --limit=50 --page=1
```

## Caching

The wrapper supports automatic caching of API responses:

```php
// Caching is enabled by default
$products = Shirtigo::products()->getAll(); // Will be cached

// Disable cache for specific request
$products = Shirtigo::products()->getAll(); // Without cache
```

## Error Handling

```php
use LaravelShirtigo\Exceptions\ShirtigoException;

try {
    $orders = Shirtigo::orders()->getAll();
} catch (ShirtigoException $e) {
    // Handle API error
    echo 'Error: ' . $e->getMessage();
    echo 'Status Code: ' . $e->getStatusCode();
}
```

## Logging

API calls are automatically logged (when enabled):

```php
// In configuration
'logging' => [
    'enabled' => true,
    'channel' => 'default',
],
```

## Testing

```bash
composer test
```

## Configuration

The complete configuration can be found in the `config/shirtigo.php` file:

```php
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
```

## License

MIT

## Support

For questions or issues, please create an issue in the GitHub repository.