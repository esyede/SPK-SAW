<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    protected $guarded = ['id'];

    public static function getAllRoles()
    {
        return Cache::rememberForever('roles.all', function () {
            return self::withCount('permissions')->latest('id')->get();
        });
    }

    public static function getForSelect()
    {
        return Cache::rememberForever('roles.getForSelect', function () {
            return self::select('id', 'name')->get();
        });
    }

    public static function flushCache()
    {
        Cache::forget('roles.all');
        Cache::forget('roles.getForSelect');
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
