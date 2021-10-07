<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crisp extends Model
{
    use HasFactory;

    protected $table = 'crisp';
    protected $guarded = 'id';
}
