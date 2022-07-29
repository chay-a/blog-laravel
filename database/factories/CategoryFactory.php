<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = [];
        $category['name'] = fake()->word();
        if (rand(0, 10) < 5) {
            $category['category_id'] = Category::inRandomOrder()->first();
        }

        return $category;
    }
}
