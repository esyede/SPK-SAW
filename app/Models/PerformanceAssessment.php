<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\User;
use App\Models\Integrity;

class PerformanceAssessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function subcriteria()
    {
        return $this->belongsTo(SubCriteria::class, 'subcriteria_code', 'subcriteria_code');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function integrity()
    {
        return $this->belongsTo(Integrity::class);
    }

    public function scopeDataPerformanceAssessment($query, $user_id)
    {
        return $query->selectRaw('performance_assessments.*, integrities.id as integrity_id, integrities.integrity, integrities.description')
            ->join('integrities', 'integrities.difference_value', '=', 'performance_assessments.gap')
            ->where('performance_assessments.user_id', $user_id)
            ->get();
    }
}
