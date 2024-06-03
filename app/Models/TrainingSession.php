<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'fighter_id',
        'training_type',
        'improvement',
        'created_at',
    ];

    public function fighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class);
    }
}
