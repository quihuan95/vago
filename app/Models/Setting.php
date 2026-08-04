<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        try {
            $settings = Cache::rememberForever('settings.all', function () {
                return static::query()->pluck('value', 'key')->all();
            });

            return $settings[$key] ?? $default;
        } catch (\Throwable) {
            try {
                return static::query()->where('key', $key)->value('value') ?? $default;
            } catch (\Throwable) {
                return $default;
            }
        }
    }

    public static function setValue(string $key, mixed $value, string $group = 'general', string $type = 'string'): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type],
        );

        Cache::forget('settings.all');
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('settings.all'));
        static::deleted(fn () => Cache::forget('settings.all'));
    }
}
