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
        $random = rand(0,1);

        $userId = null;
        $pseudo = null;
        $email = null;

        if($random<0.5) {
            $userId = User::inRandomOrder()->value('id');
        } else {
            $pseudo = $this->getUsername();
            $email = $this->getEmail();
        }

        return [
            'content' => fake()->text(2000),
            'user_id' => $userId,
            'pseudo' => $pseudo,
            'email' => $email,
            'article_id' => Article::inRandomOrder()->value('id')
        ];
    }

    public function getUsername() {
        return fake()->userName();
    }

    public function getEmail() {
        return fake()->email();
    }
}
