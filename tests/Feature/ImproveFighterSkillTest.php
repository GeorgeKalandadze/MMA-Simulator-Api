<?php

use App\Actions\Fighter\ImproveFighterSkill;
use App\Models\Fighter;
use App\Models\Skill;

beforeEach(function () {
    $this->fighter = Fighter::factory()->create([
        'balance' => 100,
    ]);

    $this->skill = Skill::factory()->create([
        'price' => 10,
    ]);

    $this->improveFighterSkillAction = new ImproveFighterSkill();
});

it('improves a fighter skill', function () {
    $this->improveFighterSkillAction->execute($this->fighter, $this->skill);

    $this->fighter->refresh();

    $skillLevel = $this->fighter->skills()->find($this->skill->id)->pivot->level;
    expect($skillLevel)->toBe(1);
    expect($this->fighter->balance)->toBe(90);
});

it('throws an exception if skill level exceeds maximum limit', function () {
    $this->fighter->skills()->attach($this->skill->id, ['level' => 5]);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Skill level cannot exceed the maximum limit of 5.');

    $this->improveFighterSkillAction->execute($this->fighter, $this->skill);
});

it('throws an exception if not enough balance to improve skill', function () {
    $this->fighter->balance = 5;
    $this->fighter->save();

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Not enough balance to improve skill.');

    $this->improveFighterSkillAction->execute($this->fighter, $this->skill);
});
