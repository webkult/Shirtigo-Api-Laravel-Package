# Product Context: Laravel Shirtigo Wrapper

## Problem
Die Shirtigo PHP SDK ist eine generische PHP-Bibliothek, die nicht speziell für Laravel optimiert ist. Laravel-Entwickler benötigen:
- Laravel-spezifische Integration (Service Provider, Facades)
- Konfigurationsmanagement über Laravel Config
- Artisan Commands für CLI-Operationen
- Eloquent-ähnliche Modelle für bessere DX
- Laravel-spezifisches Error Handling und Logging

## Lösung
Ein Laravel Wrapper, der:
- Die bestehende Shirtigo SDK als Basis nutzt
- Laravel-spezifische Features hinzufügt
- Eine intuitive, Laravel-ähnliche API bereitstellt
- Best Practices für Laravel-Entwicklung befolgt

## Zielgruppe
- Laravel-Entwickler, die Shirtigo-Dienste integrieren
- E-Commerce-Entwickler
- Print-on-Demand-Anwendungen

## Kern-APIs
Basierend auf der SDK-Analyse:
- **OrderApi**: Bestellverwaltung
- **ProductApi**: Produktverwaltung
- **DesignApi**: Design-Management
- **ImageApi**: Bildverarbeitung
- **UserApi**: Benutzerverwaltung
- **CatalogApi**: Katalog-Zugriff
- **BrandingApi**: Branding-Features
- **WarehousingApi**: Lagerverwaltung
- **WebhookApi**: Webhook-Management
- **IntegrationApi**: Integration-Management
- **ProjectApi**: Projektverwaltung

## User Experience
- Einfache Installation: `composer require vendor/laravel-shirtigo`
- Konfiguration: `php artisan vendor:publish --tag=shirtigo-config`
- Verwendung: `Shirtigo::orders()->getAll()`
- Artisan Commands: `php artisan shirtigo:sync-products`