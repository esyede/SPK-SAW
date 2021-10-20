<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function has($key)
    {
        return (bool) self::all()->whereStrict('name', $key)->count();
    }

    public static function get($key, $default = null)
    {
        if (self::has($key)) {
            return self::all()->where('name', $key)->first()->value;
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
        if ($setting = self::all()->where('name', $key)->first()) {
            return $setting->update(['name' => $key, 'value' => $value]) ? $value : false;
        }

        return self::add($key, $value);
    }

    public static function change($data)
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
}
