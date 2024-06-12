<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fighter extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'strength',
        'agility',
        'stamina',
        'balance',
        'height',
        'weight',
        'weight_division_id',
        'martial_art_style_id',
        'country_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function weightDivision(): BelongsTo
    {
        return $this->belongsTo(WeightDivision::class);
    }

    public function martialArtStyle(): BelongsTo
    {
        return $this->belongsTo(MartialArtStyle::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withPivot('level')->withTimestamps();
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function trainingSessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function fights(): BelongsToMany
    {
        return $this->belongsToMany(Fight::class)->withPivot('result', 'role')->withTimestamps();
    }
}
