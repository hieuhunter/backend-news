<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(5);
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'category_id' => $this->faker->randomElement(Category::pluck('id')),
            'title' => $title,
            'slug' => Str::slug($title, '-') . '-' . Str::lower(Str::random(6)),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->text(666),
            'image' => 'test.png',
            'status' => 'publish',
        ];
    }
}
