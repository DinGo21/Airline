<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Airplane;
use App\Models\Flight;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Airplane::factory(10)->create();

        Flight::factory()->create(["date" => "2025-03-11"]);
        Flight::factory()->create(["date" => "2025-04-01"]);
        Flight::factory()->create(["date" => "2025-04-12"]);
        Flight::factory()->create(["date" => "2025-04-13"]);
        Flight::factory()->create(["date" => "2025-04-29"]);
        Flight::factory()->create(["date" => "2025-05-20"]);
        Flight::factory()->create(["date" => "2025-06-02"]);
        Flight::factory()->create(["date" => "2025-04-28"]);
        Flight::factory()->create(["date" => "2025-07-04"]);
        Flight::factory()->create(["date" => "2025-03-11"]);
        Flight::factory()->create(["date" => "2025-04-01"]);
        Flight::factory()->create(["date" => "2025-04-12"]);
        Flight::factory()->create(["date" => "2025-04-13"]);
        Flight::factory()->create(["date" => "2025-04-29"]);
        Flight::factory()->create(["date" => "2025-05-20"]);
        Flight::factory()->create(["date" => "2025-06-02"]);
        Flight::factory()->create(["date" => "2025-04-28"]);
        Flight::factory()->create(["date" => "2025-07-04"]);
        Flight::factory(5)->create();
    }
}
