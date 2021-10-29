<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
