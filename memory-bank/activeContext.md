# Active Context: Laravel Shirtigo Wrapper

## Aktueller Fokus
Entwicklung eines Laravel Wrappers für die Shirtigo PHP SDK mit Fokus auf:
- Laravel-spezifische Integration
- Einfache API für Entwickler
- Robuste Fehlerbehandlung
- Umfassende Testabdeckung

## Nächste Schritte
1. **Projektstruktur erstellen**
   - Composer.json mit Dependencies
   - Grundlegende Ordnerstruktur
   - PSR-4 Autoloading

2. **Core Services entwickeln**
   - ShirtigoService als Hauptservice
   - API-spezifische Services (Order, Product, Design)
   - Repository Pattern implementieren

3. **Laravel Integration**
   - Service Provider erstellen
   - Facade implementieren
   - Konfigurationsdatei

4. **Models und DTOs**
   - Eloquent-ähnliche Models
   - Data Transfer Objects
   - Response-Mapping

5. **Error Handling**
   - Custom Exceptions
   - HTTP-Status-Mapping
   - Retry-Mechanismen

6. **Testing**
   - Unit Tests
   - Feature Tests
   - Mock-Integration

## Aktuelle Entscheidungen
- Verwendung der bestehenden Shirtigo SDK als Basis
- Laravel 10+ als Mindestversion
- PSR-12 Code Standard
- SOLID Design Principles

## Offene Fragen
- Caching-Strategie für API-Responses
- Artisan Commands für häufige Operationen
- Webhook-Integration
- Dokumentationsformat