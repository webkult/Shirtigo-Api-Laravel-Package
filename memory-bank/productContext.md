# Product Context: Laravel Shirtigo Wrapper

## Problem
The Shirtigo PHP SDK is a generic PHP library that is not specifically optimized for Laravel. Laravel developers need:
- Laravel-specific integration (Service Provider, Facades)
- Configuration management through Laravel Config
- Artisan Commands for CLI operations
- Eloquent-like models for better DX
- Laravel-specific error handling and logging

## Solution
A Laravel wrapper that:
- Uses the existing Shirtigo SDK as a base
- Adds Laravel-specific features
- Provides an intuitive, Laravel-like API
- Follows best practices for Laravel development

## Target Audience
- Laravel developers integrating Shirtigo services
- E-Commerce developers
- Print-on-Demand applications

## Core APIs
Based on SDK analysis:
- **OrderApi**: Order management
- **ProductApi**: Product management
- **DesignApi**: Design management
- **ImageApi**: Image processing
- **UserApi**: User management
- **CatalogApi**: Catalog access
- **BrandingApi**: Branding features
- **WarehousingApi**: Warehouse management
- **WebhookApi**: Webhook management
- **IntegrationApi**: Integration management
- **ProjectApi**: Project management

## User Experience
- Easy installation: `composer require vendor/laravel-shirtigo`
- Configuration: `php artisan vendor:publish --tag=shirtigo-config`
- Usage: `Shirtigo::orders()->getAll()`
- Artisan Commands: `php artisan shirtigo:sync-products`