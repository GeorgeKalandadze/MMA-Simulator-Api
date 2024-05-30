<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fight extends Model
{
    use HasFactory;

    protected $fillable = [
        'fighter1_id',
        'fighter2_id',
        'winner_id',
        'fight_date',
        'status',
        'location',
    ];

    public function fighter1(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'fighter1_id');
    }

    public function fighter2(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'fighter2_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'winner_id');
    }
}
