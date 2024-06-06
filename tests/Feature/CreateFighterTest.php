<?php

use App\Actions\Fighter\CreateFighter;
use App\Models\Country;
use App\Models\Fighter;
use App\Models\MartialArtStyle;
use App\Models\User;
use App\Models\WeightDivision;

beforeEach(function () {

    $this->user = User::factory()->create();
    $this->country = Country::first();
    $this->weightDivision = WeightDivision::where('min_weight', '<=', 75)
        ->where('max_weight', '>=', 75)
        ->first();
    $this->martialArtStyle = MartialArtStyle::first();
    $this->createFighterAction = new CreateFighter();
});

it('creates a fighter', function () {
    $data = [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'height' => 180,
        'weight' => 75,
        'martial_art_style_id' => $this->martialArtStyle->id,
        'country_id' => $this->country->id,
    ];

    $fighter = $this->createFighterAction->execute($data, $this->user);

    expect($fighter)->toBeInstanceOf(Fighter::class);
    expect($fighter->firstname)->toBe('John');
    expect($fighter->lastname)->toBe('Doe');
    expect($fighter->height)->toBe(180);
    expect($fighter->weight)->toBe(75);
    expect($fighter->martial_art_style_id)->toBe($this->martialArtStyle->id);
    expect($fighter->country_id)->toBe($this->country->id);
    expect($fighter->user_id)->toBe($this->user->id);

    $this->assertDatabaseHas('fighters', [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'height' => 180,
        'weight' => 75,
        'martial_art_style_id' => $this->martialArtStyle->id,
        'country_id' => $this->country->id,
        'user_id' => $this->user->id,
    ]);
});

it('assigns the correct weight division', function () {
    $data = [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'height' => 180,
        'weight' => 75,
        'martial_art_style_id' => $this->martialArtStyle->id,
        'country_id' => $this->country->id,
    ];
    $fighter = $this->createFighterAction->execute($data, $this->user);
    expect($fighter->weight_division_id)->toBe($this->weightDivision->id);

});
