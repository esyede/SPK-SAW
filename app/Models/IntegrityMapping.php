<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criteria;
use App\Models\User;
use App\Models\SubCriteria;
use App\Models\PerformanceAssessment;

class IntegrityMapping extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongTo(User::class);
    }

    public function performance_assessment()
    {
        return $this->belongsTo(PerformanceAssessment::class);
    }
}
