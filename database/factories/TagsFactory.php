<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = Str::ucfirst($this->faker->unique()->word());
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
        ];
    }
}
