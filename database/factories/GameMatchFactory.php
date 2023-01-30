<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameMatch>
 */
class GameMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startTime = fake()->time();
        do{
            $endTime = fake()->time();
        }while($endTime<=$startTime);
        $team1_id = fake()->numberBetween(1,8);
        do{
            $team2_id = fake()->numberBetween(1,8);
        }while($team2_id == $team1_id);
        return [
            'startTime' => $startTime,
            'endTime' => $endTime,
            'game_id' => fake()->numberBetween(1,5),
            'team1_id' => $team1_id,
            'team2_id' => $team2_id,
        ];
    }
}
