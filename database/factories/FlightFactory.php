<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date" => fake()->date(),
            "departure" => fake()->country(),
            "arrival" => fake()->country(),
            "image" => fake()->imageUrl(),
            "airplane_id" => fake()->randomDigit(),
            "status" => fake()->boolean()
        ];
    }
}
