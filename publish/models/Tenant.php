<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Isaacdew\LaravelFortifyMultitenancy\TenantScoped;

class Tenant extends Model
{
    use HasFactory, TenantScoped;

    protected static function getTenantKey(): string
    {
        return 'id';
    }
}
