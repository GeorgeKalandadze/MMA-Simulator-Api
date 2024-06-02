<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\ImproveFighterSkill;
use App\Http\Requests\ImproveSkillRequest;
use Illuminate\Http\Request;

class ImproveFighterSkillController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ImproveSkillRequest $request, ImproveFighterSkill $improveFighterSkill)
    {
        $data = $request->validated();
        $user = auth()->user();
        $fighter = $user->fighter;

        $result = $improveFighterSkill->execute($fighter, $data['skill_id']);

        if ($result['success']) {
            return response()->json(['message' => $result['message']], 200);
        }

        return response()->json(['message' => $result['message']], 400);
    }
}
