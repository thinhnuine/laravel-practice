<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake()->title(),
            'content' => fake()->sentence(5),
            'status' => fake()->randomElement(['unpublish', 'published', 'draft']),
            'user_id' => User::all()->random()->id,
        ];
    }
}
