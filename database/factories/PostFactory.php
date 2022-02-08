<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'title' => $this->faker->sentence(rand(5, 10), true),
            'content' => $this->faker->paragraph(rand(8, 16), true),
            'public_post' => $this->faker->boolean(80),
            'author_id' => User::inRandomOrder()->first()->id,
        ];
    }
}