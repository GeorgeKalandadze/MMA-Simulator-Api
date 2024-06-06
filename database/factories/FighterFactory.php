<?php

namespace Database\Factories;

use App\Models\Fighter;
use App\Models\Country;
use App\Models\WeightDivision;
use App\Models\MartialArtStyle;
use Illuminate\Database\Eloquent\Factories\Factory;

class FighterFactory extends Factory
{

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'strength' => $this->faker->numberBetween(1, 100),
            'agility' => $this->faker->numberBetween(1, 100),
            'stamina' => $this->faker->numberBetween(1, 100),
            'balance' => $this->faker->numberBetween(50, 5000),
            'height' => $this->faker->numberBetween(150, 200),
            'weight' => $this->faker->numberBetween(50, 120),
            'weight_division_id' => WeightDivision::inRandomOrder()->first()->id,
            'martial_art_style_id' => MartialArtStyle::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }
}