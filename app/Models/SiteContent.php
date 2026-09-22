<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = ['key', 'value'];

    public static function value(string $key, ?string $fallback = null): ?string
    {
        return static::where('key', $key)->value('value') ?? $fallback;
    }
}
