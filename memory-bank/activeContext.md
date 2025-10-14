# Active Context: Laravel Shirtigo Wrapper

## Current Focus
Development of a Laravel wrapper for the Shirtigo PHP SDK with focus on:
- Laravel-specific integration
- Simple API for developers
- Robust error handling
- Comprehensive test coverage

## Next Steps
1. **Create project structure**
   - Composer.json with dependencies
   - Basic folder structure
   - PSR-4 autoloading

2. **Develop core services**
   - ShirtigoService as main service
   - API-specific services (Order, Product, Design)
   - Implement repository pattern

3. **Laravel integration**
   - Create service provider
   - Implement facade
   - Configuration file

4. **Models and DTOs**
   - Eloquent-like models
   - Data transfer objects
   - Response mapping

5. **Error handling**
   - Custom exceptions
   - HTTP status mapping
   - Retry mechanisms

6. **Testing**
   - Unit tests
   - Feature tests
   - Mock integration

## Current Decisions
- Use existing Shirtigo SDK as base
- Laravel 10+ as minimum version
- PSR-12 code standard
- SOLID design principles

## Open Questions
- Caching strategy for API responses
- Artisan commands for common operations
- Webhook integration
- Documentation format