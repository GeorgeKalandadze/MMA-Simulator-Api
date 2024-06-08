<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Enums\TrainingType;

class TrainFighter
{
    public function execute(Fighter $fighter, TrainingType $trainingType, int $intensity): void
    {
        $this->validateTraining($fighter, $trainingType, $intensity);

        $baseImprovement = $this->getBaseImprovement($trainingType);
        $improvement = (int) ($baseImprovement * $intensity * $this->getRandomFactor());

        if ($this->isOvertrained($fighter, $trainingType)) {
            $improvement *= 0.5;
        }

        DB::transaction(function () use ($fighter, $trainingType, $improvement) {
            $fighter->{$trainingType->value} += $improvement;
            $fighter->save();

            TrainingSession::create([
                'fighter_id' => $fighter->id,
                'training_type' => $trainingType->value,
                'improvement' => $improvement,
            ]);
        });

    }

    private function validateTraining(Fighter $fighter, TrainingType $trainingType, int $intensity)
    {
        // Validate intensity
        if ($intensity < 1 || $intensity > 10) {
            throw new \InvalidArgumentException('Intensity must be between 1 and 10.');
        }

        // Validate weekly training limit
        $weekAgo = Carbon::now()->subWeek();
        $trainingCount = TrainingSession::where('fighter_id', $fighter->id)
            ->where('created_at', '>=', $weekAgo)
            ->count();

        if ($trainingCount >= 3) {
            throw new \Exception('Fighter cannot train more than three times in a week.');
        }
    }

    private function getBaseImprovement(TrainingType $type): int
    {
        $base = [
            TrainingType::Strength->value => 1,
            TrainingType::Agility->value => 1,
            TrainingType::Stamina->value => 1,
        ];

        return $base[$type->value];
    }

    private function getRandomFactor(): float
    {
        return mt_rand(80, 120) / 100;
    }

    private function isOvertrained(Fighter $fighter, TrainingType $trainingType): bool
    {
        $weekAgo = Carbon::now()->subWeek();
        $recentSessions = TrainingSession::where('fighter_id', $fighter->id)
            ->where('training_type', $trainingType->value)
            ->where('created_at', '>=', $weekAgo)
            ->count();

        return $recentSessions >= 3;
    }
}
