<?php

namespace Database\Factories;

use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSessionFactory extends Factory
{
    protected $model = TrainingSession::class;

    public function definition()
    {
        return [
            'fighter_id' => \App\Models\Fighter::factory(),
            'training_type_id' => \App\Models\TrainingType::factory(),
            'improvement' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
