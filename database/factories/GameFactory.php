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
            'location' => fake()->randomElement([
                'Universidad de Murcia, Pista 1',
                'Universidad de Murcia, Pista 2',
                'Universidad de Murcia, Pista 3',
                'Universidad de Murcia, Pabellón',
                'Club de Tenis, Pista futbol',
                'La Vega, Pista 1',
                'La Vega, Pista 2',
                'CDM La Flota, Pista cubierta',
            ]),
            'date' => fake()->date(),
            'sport' => fake()->randomElement(['Futbol Sala', 'Futbol 7', 'Baloncesto']),
            'description' => fake()->randomElement([
                'Traed camisetas de distintos colores por si alguien falla.',
                'Que alguien se lleve un inflador por si necesitamos para el balón.',
                'Quedamos en la parada de tranvía mas cercana al campo',
                'Hay aparcamiento gratuito en los alrededores',
            ]),
            'creator' => fake()->numberBetween(1,5),
        ];
    }
}
