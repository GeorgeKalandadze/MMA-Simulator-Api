<?php

use App\Actions\Fighter\TrainFighter;
use App\Models\Fighter;
use App\Models\TrainingSession;
use App\Models\TrainingType;
use Carbon\Carbon;

use function Pest\Laravel\withExceptionHandling;

beforeEach(function () {
    Carbon::setTestNow(Carbon::now());
});

it('trains a fighter successfully', function () {
    $fighter = Fighter::factory()->create();
    $strengthTraining = TrainingType::where('name', 'strength')->first();
    $initialStrength = $fighter->strength;

    $action = new TrainFighter();
    $action->execute($fighter, $strengthTraining, 2);

    $fighter->refresh();

    expect(TrainingSession::where('fighter_id', $fighter->id)->count())->toBe(1);
});

it('throws an exception if training more than three times a week', function () {
    $fighter = Fighter::factory()->create();
    $strengthTraining = TrainingType::where('name', 'agility')->first();
    TrainingSession::factory()->count(3)->create([
        'fighter_id' => $fighter->id,
        'training_type_id' => $strengthTraining->id,
        'created_at' => Carbon::now()->subDays(1),
    ]);

    withExceptionHandling();

    expect(function () use ($fighter, $strengthTraining) {
        $action = new TrainFighter();
        $action->execute($fighter, $strengthTraining, 2);
    })->toThrow(\Exception::class);
});

it('reduces improvement if fighter is overtrained', function () {
    $fighter = Fighter::factory()->create();
    $strengthTraining = TrainingType::where('name', 'strength')->first();
    TrainingSession::factory()->create([
        'fighter_id' => $fighter->id,
        'training_type_id' => $strengthTraining->id,
        'created_at' => Carbon::now()->subDays(1),
    ]);
    $initialStrength = $fighter->strength;

    $action = new TrainFighter();
    $action->execute($fighter, $strengthTraining, 2);

    $fighter->refresh();

    expect($fighter->strength)->toBeLessThan($initialStrength + (2 * 1));
});
