<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'message' => $this->faker->paragraph,
            'user_id' => $this->faker->numberBetween(1, 50),
            'repository_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
