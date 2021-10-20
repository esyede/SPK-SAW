<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder').'800.png')
            ->useFallbackPath(config('app.placeholder').'800.png');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
