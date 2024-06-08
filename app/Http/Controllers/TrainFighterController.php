<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\TrainFighter;
use App\Http\Requests\TrainFighterRequest;
use Illuminate\Http\JsonResponse;

class TrainFighterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TrainFighter $trainFighter, TrainFighterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $fighter = $user->fighter;

         $trainFighter->execute(
            $fighter,
            $data['training_type'],
            $data['intensity']
        );

        return response()->json([
            'message' => 'Training successful',
        ]);
    }
}
