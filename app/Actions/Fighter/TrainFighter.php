<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\DB;

class TrainFighter
{
    public function execute(Fighter $fighter, string $trainingType, int $intensity): array
    {
        $baseImprovement = $this->getBaseImprovement($trainingType);
        $improvement = (int) ($baseImprovement * $intensity * $this->getRandomFactor());

        if ($this->isOvertrained($fighter)) {
            $improvement *= 0.5;
        }

        DB::transaction(function () use ($fighter, $trainingType, $improvement) {
            $fighter->{$trainingType} += $improvement;
            $fighter->save();

            TrainingSession::create([
                'fighter_id' => $fighter->id,
                'training_type' => $trainingType,
                'improvement' => $improvement,
            ]);
        });

        return [
            'improvement' => $improvement,
            'new_stats' => $fighter->only('strength', 'agility', 'stamina')
        ];
    }

    private function getBaseImprovement(string $type): int
    {
        $base = [
            'strength' => 1,
            'agility' => 1,
            'stamina' => 1,
        ];

        return $base[$type];
    }

    private function getRandomFactor(): float
    {
        return mt_rand(80, 120) / 100;
    }

    private function isOvertrained(Fighter $fighter): bool
    {
        $recentSessions = TrainingSession::where('fighter_id', $fighter->id)
            ->where('created_at', '>', now()->subDays(7))
            ->count();

        return $recentSessions > 10;
    }
}
