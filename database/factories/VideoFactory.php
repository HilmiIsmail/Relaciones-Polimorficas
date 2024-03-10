<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(random_int(1, 3), true),
            'descripcion' => fake()->text(),
            'duracion' => fake()->randomFloat(2, 1, 60),
            'user_id' => User::all()->random()->id,
        ];
    }
}
