<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCriteria;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sub_criteria()
    {
        return $this->hasMany(SubCriteria::class);
    }
}
