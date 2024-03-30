<?php

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    protected $model = Rate::class;

    public function definition()
    {
        return [
            'score' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, 50),
            'repository_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
