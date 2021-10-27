<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function performance_assessment()
    {
        return $this->hasMany(PerformanceAssessment::class);
    }
}
