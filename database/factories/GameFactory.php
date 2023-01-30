<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => fake()->streetAddress(),
            'date' => fake()->date(),
            'sport' => fake()->randomElement(['Futbol Sala', 'Futbol 7', 'Baloncesto']),
            'description' => fake()->realText($maxNbChars = 150, $indexSize = 2),
            'creator' => fake()->numberBetween(1,5),
        ];
    }
}
