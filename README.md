# laravel-fortify-multitenancy
## Installation

`composer require isaacdew/laravel-fortify-multitenancy`

`php artisan vendor:publish --tag=laravel-fortify-multitenancy-migrations`

Add the `SetTenant` middleware to the top of the `$middleware` property in your `Kernel.php`:
```php
namespace App\Http;

use App\Http\Middleware\SetTenant;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        SetTenant::class,
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        ...
```

