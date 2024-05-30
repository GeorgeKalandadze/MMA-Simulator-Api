<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function fighters(): BelongsToMany
    {
        return $this->belongsToMany(Fighter::class)->withPivot('level')->withTimestamps();
    }
}
