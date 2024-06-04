<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\ImproveFighterSkill;
use App\Http\Requests\ImproveSkillRequest;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImproveFighterSkillController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __invoke(Skill $skill, ImproveFighterSkill $improveFighterSkill): JsonResponse
    {
        $user = auth()->user();
        $fighter = $user->fighter;

        $improveFighterSkill->execute($fighter, $skill);

        return response()->json(['message' => 'Skill improved successfully'], 200);
    }
}
