<?php

namespace Isaacdew\LaravelFortifyMultitenancy;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait TenantScoped
{
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('tenantScoped', function (Builder $builder) {
            if(! config('tenant.id')) {
                return;
            }

            $builder->where(self::getTenantKey(), '=', config('tenant.id'));
        });

        static::creating(function(Model $model) {
            if(! config('tenant.id')) {
                return;
            }

            $model->{self::getTenantKey()} = config('tenant.id');
        });

        static::updating(function(Model $model) {
            if(! config('tenant.id')) {
                return;
            }

            $model->{self::getTenantKey()} = config('tenant.id');
        });
    }

    protected static function getTenantKey(): string
    {
        return 'tenant_id';
    }
}
