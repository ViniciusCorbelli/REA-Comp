<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'repository_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
