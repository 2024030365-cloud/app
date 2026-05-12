<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Str;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'nombre_empresa',
            'slug', 
        ];
    }

    protected static function booted()
    {
        static::creating(function ($tenant) {
            $tenant->slug = strtoupper(Str::random(6));
        });
    }

    public function getTenantKeyName(): string
    {
        return 'slug';
    }
}