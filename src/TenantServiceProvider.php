<?php

namespace Isaacdew\LaravelFortifyMultitenancy;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publish/migrations/2022_04_30_214344_create_tenants_table.php' => base_path('/database/migrations/2022_04_30_214344_create_tenants_table.php'),
            __DIR__ . '/../publish/migrations/2022_04_30_215100_add_tenant_id_to_users_table.php' => base_path('/database/migrations/2022_04_30_215100_add_tenant_id_to_users_table.php'),
            __DIR__ . '/../publish/models/Tenant.php' => app_path('/Models/Tenant.php'),
        ], 'laravel-fortify-multitenancy-migrations');

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)
                ->when(!config('tenant.id'), fn ($query) => $query->whereNull('tenant_id'))
                ->first();

            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            }
        });
    }
}
