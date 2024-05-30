<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightDivision extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'min_weight', 'max_weight'];
}
