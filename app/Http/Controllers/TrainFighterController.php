<?php

namespace App\Http\Controllers;

use App\Actions\Fighter\TrainFighter;
use App\Http\Requests\TrainFighterRequest;


class TrainFighterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TrainFighter $trainFighter, TrainFighterRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $fighter = $user->fighter;

        $result = $trainFighter->execute(
            $fighter,
            $data['training_type'],
            $data['intensity']
        );

        return response()->json([
            'message' => 'Training successful',
            'improvement' => $result['improvement'],
            'new_stats' => $result['new_stats']
        ]);
    }
}
