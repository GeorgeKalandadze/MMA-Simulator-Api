<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\CreateFighter;
use App\Http\Requests\FighterRequest;
use Illuminate\Http\JsonResponse;

class CreateFighterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FighterRequest $request, CreateFighter $createFighter): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $fighter = $createFighter->execute($data, $user);

        return response()->json($fighter, 201);
    }
}
