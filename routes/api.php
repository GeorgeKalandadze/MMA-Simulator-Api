<?php

use App\Http\Controllers\CreateFighterController;
use App\Http\Controllers\ImproveFighterSkillController;
use App\Http\Controllers\TrainFighterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/fighters', CreateFighterController::class)->middleware('permission:create_fighter');
    Route::post('/fighter/{skill}/improve', ImproveFighterSkillController::class);
    Route::post('/fighters/train', TrainFighterController::class);
});

require __DIR__.'/auth.php';
