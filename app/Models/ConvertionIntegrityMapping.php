<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\User;
use App\Models\Integrity;

class ConvertionIntegrityMapping extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongTo(User::class);
    }

    public function criteria()
    {
        return $this->belongTo(Criteria::class);
    }

    public function sub_criteria()
    {
        return $this->belongsTo(SubCriteria::class);
    }

    public function integrity()
    {
        return $this->belongsTo(Integrity::class);
    }
}
