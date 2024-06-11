<?php

namespace Database\Factories;

use App\Models\TrainingType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingTypeFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['strength', 'agility', 'stamina']),
        ];
    }
}
