<?php

namespace Isaacdew\LaravelFortifyMultitenancy;

use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/../publish/migrations/2022_04_30_214344_create_tenants_table.php' => base_path('/database/migrations/2022_04_30_214344_create_tenants_table'),
            __DIR__ . '/../publish/migrations/2022_04_30_215100_add_tenant_id_to_users_table.php' => base_path('/database/migrations/2022_04_30_215100_add_tenant_id_to_users_table.php'),
            __DIR__ . '/../publish/models/Tenant.php' => app_path('/Models/migrations/Tenant.php'),
        ]);
    }
}
