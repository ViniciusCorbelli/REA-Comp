<?php

namespace Database\Factories;

use App\Models\FavorityComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavorityCommentFactory extends Factory
{
    protected $model = FavorityComment::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'comment_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
