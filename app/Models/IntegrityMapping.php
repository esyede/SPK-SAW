<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criteria;
use App\Models\User;
use App\Models\SubCriteria;

class IntegrityMapping extends Model
{
    use HasFactory;

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function sub_criteria()
    {
        return $this->belongsTo(SubCriteria::class, 'subcriteria_code', 'subcriteria_code');
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
