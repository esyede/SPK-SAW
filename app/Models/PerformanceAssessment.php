<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IntegrityMapping;
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\User;
use App\Models\Integrity;

class PerformanceAssessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function integrity_mappping()
    {
        return $this->hasOne(IntegrityMapping::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function subcriteria()
    {
        return $this->belongsTo(SubCriteria::class,'subcriteria_code','subcriteria_code');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
