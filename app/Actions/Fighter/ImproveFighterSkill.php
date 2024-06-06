<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\Skill;
use Exception;
use Illuminate\Support\Facades\DB;

class ImproveFighterSkill
{
    /**
     * @throws Exception
     */
    public function execute(Fighter $fighter, Skill $skill): void
    {
        try {
            DB::beginTransaction();
            $currentSkillLevel = $fighter->skills()->find($skill->getKey())?->pivot?->level ?? 0;
            if ($currentSkillLevel >= 5) {
                throw new Exception('Skill level cannot exceed the maximum limit of 5.');
            }

            $improvementCost = $skill->price * ($currentSkillLevel + 1);

            if ($fighter->balance < $improvementCost) {
                throw new Exception('Not enough balance to improve skill.');
            }

            $fighter->balance -= $improvementCost;
            $fighter->save();
            $fighter->skills()->syncWithoutDetaching([$skill->getKey() => ['level' => $currentSkillLevel + 1]]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
