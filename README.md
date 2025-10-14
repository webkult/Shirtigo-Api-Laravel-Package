# Laravel Shirtigo Wrapper

Ein Laravel Wrapper für die Shirtigo PHP API SDK, der die Integration von Shirtigo-Diensten in Laravel-Anwendungen vereinfacht.

## Installation

```bash
composer require laravel-shirtigo/wrapper
```

## Konfiguration

Publiziere die Konfigurationsdatei:

```bash
php artisan vendor:publish --tag=shirtigo-config
```

Konfiguriere deine Umgebungsvariablen in der `.env`-Datei:

```env
SHIRTIGO_API_KEY=your_api_key_here
SHIRTIGO_BASE_URL=https://cockpit.shirtigo.com/api/
SHIRTIGO_CACHE_ENABLED=true
SHIRTIGO_CACHE_TTL=3600
SHIRTIGO_RETRY_ATTEMPTS=3
SHIRTIGO_LOGGING_ENABLED=true
```

## Verwendung

### Facade verwenden

```php
use LaravelShirtigo\Facades\Shirtigo;

// Bestellungen abrufen
$orders = Shirtigo::orders()->getAll();

// Einzelne Bestellung abrufen
$order = Shirtigo::orders()->get('ORDER-123');

// Produkte abrufen
$products = Shirtigo::products()->getAll();

// Design erstellen
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
// Alle Bestellungen abrufen
$orders = Shirtigo::orders()->getAll(
    page: 1,
    filter: 1, // Status-Filter
    items: 50,
    search: 'Suchbegriff'
);

// Bestellung erstellen
$order = Shirtigo::orders()->create([
    'customer' => [...],
    'products' => [...],
    'delivery_address' => [...]
]);

// Bestellung stornieren
Shirtigo::orders()->cancel('ORDER-123');

// Zahlung wiederholen
Shirtigo::orders()->retryPayment('ORDER-123');
```

### Product Service

```php
// Alle Produkte abrufen
$products = Shirtigo::products()->getAll();

// Produkt erstellen
$product = Shirtigo::products()->create([
    'name' => 'T-Shirt',
    'description' => 'Ein cooles T-Shirt',
    'base_product_id' => 123
]);

// Produkt aktualisieren
Shirtigo::products()->update(123, [
    'name' => 'Aktualisierter Name'
]);
```

### Design Service

```php
// Design aus Datei erstellen
$design = Shirtigo::designs()->createFromFile('/path/to/design.png', [
    'name' => 'Mein Design'
]);

// Design aus URL erstellen
$design = Shirtigo::designs()->createFromUrl('https://example.com/design.png');

// Design aus Base64 erstellen
$design = Shirtigo::designs()->createFromBase64($base64Data);
```

### Image Service

```php
// Mockup-Bilder generieren
$mockups = Shirtigo::images()->generateMockupImages([
    'product_id' => 123,
    'design_id' => 456
]);

// Hintergrund entfernen
$result = Shirtigo::images()->removeBackground([
    'image_url' => 'https://example.com/image.png'
]);
```

## Models

Der Wrapper bietet Eloquent-ähnliche Models für API-Responses:

```php
use LaravelShirtigo\Models\Order;

$order = Order::fromArray($orderData);

echo $order->getReference();
echo $order->getTotalPrice();
echo $order->isPaid() ? 'Bezahlt' : 'Nicht bezahlt';

$products = $order->getProducts();
foreach ($products as $product) {
    echo $product->getQuantity() . 'x ' . $product->getColor();
}
```

## Artisan Commands

### Produkte synchronisieren

```bash
php artisan shirtigo:sync-products --limit=100 --force
```

### Bestellungen synchronisieren

```bash
php artisan shirtigo:sync-orders --status=1 --limit=50 --page=1
```

## Caching

Der Wrapper unterstützt automatisches Caching von API-Responses:

```php
// Caching ist standardmäßig aktiviert
$products = Shirtigo::products()->getAll(); // Wird gecacht

// Cache für bestimmte Anfrage deaktivieren
$products = Shirtigo::products()->getAll(); // Ohne Cache
```

## Error Handling

```php
use LaravelShirtigo\Exceptions\ShirtigoException;

try {
    $orders = Shirtigo::orders()->getAll();
} catch (ShirtigoException $e) {
    // API-Fehler behandeln
    echo 'Fehler: ' . $e->getMessage();
    echo 'Status Code: ' . $e->getStatusCode();
}
```

## Logging

API-Aufrufe werden automatisch geloggt (wenn aktiviert):

```php
// In der Konfiguration
'logging' => [
    'enabled' => true,
    'channel' => 'default',
],
```

## Testing

```bash
composer test
```

## Konfiguration

Die vollständige Konfiguration findest du in der `config/shirtigo.php`-Datei:

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

## Lizenz

MIT

## Support

Bei Fragen oder Problemen erstelle bitte ein Issue im GitHub Repository.