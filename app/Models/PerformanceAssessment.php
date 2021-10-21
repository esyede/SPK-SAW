<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IntegrityMapping;

class PerformanceAssessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function integrity_mappping()
    {
        return $this->hasOne(IntegrityMapping::class);
    }
}
