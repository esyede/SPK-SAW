<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $guarded = ['id'];

    public static function getAllSettings()
    {
        return Cache::rememberForever('settings.all', function () {
            return self::all();
        });
    }

    public static function getSettingsArray()
    {
        return Cache::rememberForever('settings.toArray', function () {
            return self::getAllSettings()->pluck('value', 'name')->toArray();
        });
    }

    public static function has($key)
    {
        return (boolean)self::getAllSettings()->whereStrict('name', $key)->count();
    }

    public static function get($key, $default = null)
    {
        if (self::has($key)) {
            return self::getAllSettings()->where('name', $key)->first()->value;
        }

        return $default;
    }

    public static function add($key, $value)
    {
        if (self::has($key)) {
            return self::set($key, $value);
        }

        return self::create(['name' => $key, 'value' => $value]) ? $value : false;
    }

    public static function set($key, $value)
    {
        if ($setting = self::getAllSettings()->where('name', $key)->first()) {
            return $setting->update(['name' => $key, 'value' => $value]) ? $value : false;
        }

        return self::add($key, $value);
    }

    public static function updateSettings($data)
    {
        foreach ($data as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function remove($key)
    {
        if (self::has($key)) {
            return self::whereName($key)->delete();
        }

        return false;
    }

    public static function flushCache()
    {
        Cache::forget('settings.all');
        Cache::forget('settings.toArray');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function () {
            self::flushCache();
        });

        static::deleted(function () {
            self::flushCache();
        });
    }
}
