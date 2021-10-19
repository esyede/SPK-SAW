<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceAssessment extends Model
{
    use HasFactory;

    protected $table = 'performance_assessments';
    protected $guarded = ['id'];
}
