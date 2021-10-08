<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $primaryKey = 'kode_kriteria';
    public $incrementing = false;
}
