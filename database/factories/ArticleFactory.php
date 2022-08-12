<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::count() ? User::pluck('id')->random() : User::factory(),
            'category_id' => Category::count() ? Category::pluck('id')->random() : Category::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'image' => $this->faker->image('public/storage/images', 50, 50, null, false)
        ];
    }
}
