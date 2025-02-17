<?php

namespace Database\Factories;

use App\Models\Airplane;
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
        $airplane = Airplane::find(fake()->randomDigitNot(0));

        return [
            "date" => fake()->date("Y-m-d", "+10 years"),
            "departure" => fake()->country(),
            "arrival" => fake()->country(),
            "image" => fake()->imageUrl(),
            "airplane_id" => $airplane->id,
            "available_places" => $airplane->max_places,
            "status" => fake()->boolean()
        ];
    }
}
