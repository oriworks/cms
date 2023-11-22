<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, HasUuids;

    protected function resource(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => explode('.', $attributes['name'])[0],
        );
    }

    protected function action(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => explode('.', $attributes['name'])[1] ?? 'all',
        );
    }
}
