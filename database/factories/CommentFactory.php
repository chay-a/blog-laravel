<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $comment = [
            'content' => fake()->text(2000),
            'article_id' => Article::inRandomOrder()->first(),
        ];

        if (rand(0, 1) < 0.5) {
            $comment['user_id'] = User::inRandomOrder()->first();
        } else {
            $comment['pseudo'] = fake()->userName();
            $comment['email'] = fake()->email();
        }

        return $comment;
    }
}
