<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{
    protected $guarded = ['id'];

    public static function getWithPermissions()
    {
        return self::with('permissions')->get();
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
