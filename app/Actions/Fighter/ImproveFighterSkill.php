<?php

namespace App\Actions\Fighter;

use App\Models\Fighter;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Exception;

class ImproveFighterSkill
{
    public function execute(Fighter $fighter, int $skillId): array
    {
        DB::beginTransaction();

        try {
            $skill = Skill::findOrFail($skillId);
            $currentSkillLevel = $fighter->skills()->where('skill_id', $skillId)->first()->pivot->level ?? 0;

            if ($currentSkillLevel >= 5) {
                throw new Exception('Skill level cannot exceed the maximum limit of 5.');
            }

            $improvementCost = $skill->price * ($currentSkillLevel + 1);

            if ($fighter->balance < $improvementCost) {
                throw new Exception('Not enough balance to improve skill.');
            }

            $fighter->balance -= $improvementCost;
            $fighter->save();
            $fighter->skills()->syncWithoutDetaching([$skillId => ['level' => $currentSkillLevel + 1]]);

            DB::commit();

            return ['success' => true, 'message' => 'Skill improved successfully.'];
        } catch (Exception $e) {
            DB::rollBack();

            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
