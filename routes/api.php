<?php


use App\Http\Controllers\CreateFighterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/fighters', CreateFighterController::class);
});

require __DIR__.'/auth.php';
