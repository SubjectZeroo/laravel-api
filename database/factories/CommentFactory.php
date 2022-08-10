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
        return [
            'user_id' => User::count() ? User::pluck('id')->random() : User::factory(),
            'article_id' => Article::count() ? Article::pluck('id')->random() : Article::factory(),
            'text' => $this->faker->paragraph()
        ];
    }
}
