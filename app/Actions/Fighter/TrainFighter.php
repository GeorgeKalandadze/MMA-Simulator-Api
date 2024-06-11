<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\TrainingSession;
use App\Models\TrainingType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrainFighter
{
    /**
     * @throws \Exception
     */
    public function execute(Fighter $fighter, TrainingType $trainingType, int $intensity): void
    {
        $this->validateTraining($fighter);

        $baseImprovement = $this->getBaseImprovement($trainingType);
        $improvement = (int) ($baseImprovement * $intensity * getRandomFactor());

        if ($this->isOvertrained($fighter, $trainingType)) {
            $improvement *= 0.5;
        }

        DB::transaction(function () use ($fighter, $trainingType, $improvement) {
            $fighter->{$trainingType->name} += $improvement;
            $fighter->save();

            TrainingSession::create([
                'fighter_id' => $fighter->id,
                'training_type_id' => $trainingType->id,
                'improvement' => $improvement,
            ]);
        });

    }

    /**
     * @throws \Exception
     */
    private function validateTraining(Fighter $fighter)
    {
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
            'strength' => 1,
            'agility' => 1,
            'stamina' => 1,
        ];

        return $base[$type->name];
    }

    private function isOvertrained(Fighter $fighter, TrainingType $trainingType): bool
    {
        $weekAgo = Carbon::now()->subWeek();
        $recentSessions = TrainingSession::where('fighter_id', $fighter->id)
            ->where('training_type_id', $trainingType->id)
            ->where('created_at', '>=', $weekAgo)
            ->count();

        return $recentSessions >= 1;
    }
}
