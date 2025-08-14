<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'author_id' => fake()->numberBetween(1, 10),
        ];
    }
}
