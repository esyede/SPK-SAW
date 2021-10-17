<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{
    protected $guarded = ['id'];

    public static function getWithPermissions()
    {
        return Cache::rememberForever('permissions.getWithPermissions', function () {
            return self::with('permissions')->get();
        });
    }

    public static function flushCache()
    {
        Cache::forget('permissions.getWithPermissions');
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

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
