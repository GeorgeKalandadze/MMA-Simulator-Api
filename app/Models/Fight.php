<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fight extends Model
{
    use HasFactory;

    protected $fillable = [
        'fight_date',
        'status',
        'location',
    ];

    public function fighters(): BelongsToMany
    {
        return $this->belongsToMany(Fighter::class)->withPivot('result')->withTimestamps();
    }
}
