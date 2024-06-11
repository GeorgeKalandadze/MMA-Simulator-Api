<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\TrainFighter;
use App\Http\Requests\TrainFighterRequest;
use App\Models\TrainingType;
use Illuminate\Http\JsonResponse;

class TrainFighterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws \Exception
     */
    public function __invoke(TrainFighter $trainFighter, TrainFighterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $fighter = $user->fighter;
        $trainingType = TrainingType::findOrFail($data['training_type']);
        $intensity = $data['intensity'];

        $trainFighter->execute($fighter, $trainingType, $intensity);

        return response()->json([
            'message' => 'Training successful',
        ]);
    }
}
