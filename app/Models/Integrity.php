<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function integrity_mapping()
    {
        return $this->hasMany(IntegrityMapping::class);
    }
}
