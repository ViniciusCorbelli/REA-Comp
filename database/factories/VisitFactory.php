<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    protected $model = Visit::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-12 months', 'now');
        
        return [
            'date' => $date->format('Y-m-d'),
            'repository_id' => $this->faker->numberBetween(1, 50),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
