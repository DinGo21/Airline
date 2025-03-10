<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAllFlights(): void
    {
        Airplane::factory(10)->create();
        Flight::factory(10)->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->get(route("apiflightindex"));

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function test_getOneFlight(): void
    {
        $airplane = Airplane::factory(10)->create();
        $flight = Flight::factory()->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->get(route("apiflightshow", $flight->id));

        $response->assertStatus(200)->assertJsonFragment(["id" => $flight->id]);
    }

    public function test_createFlight(): void
    {
        $airplane = Airplane::factory()->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $user->update(["admin" => 1]);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->post(route("apiflightstore"), [
                "date" => "2025-05-05",
                "departure" => "test",
                "arrival" => "test",
                "image" => "test",
                "airplaneId" => $airplane->id,
                "availablePlaces" => $airplane->max_places,
                "status" => 1
            ]);

        $response->assertStatus(200)->assertJsonFragment([
            "date" => "2025-05-05",
            "departure" => "test",
            "arrival" => "test",
            "image" => "test",
            "airplane_id" => $airplane->id,
            "available_places" => $airplane->max_places,
            "status" => 1
        ]);
    }

    public function test_updateFlight(): void
    {
        $airplane = Airplane::factory(10)->create();
        $flight = Flight::factory()->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $user->update(["admin" => 1]);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->put(route("apiflightupdate", $flight->id), [
                "date" => "2025-05-05",
                "departure" => "test",
                "arrival" => "test",
                "image" => "test",
                "airplaneId" => $flight->airplane_id,
                "availablePlaces" => $flight->available_places,
                "status" => 1
            ]);

        $response->assertStatus(200)->assertJsonFragment([
            "date" => "2025-05-05",
            "departure" => "test",
            "arrival" => "test",
            "image" => "test",
            "airplane_id" => $flight->airplane_id,
            "available_places" => $flight->available_places,
            "status" => 1
        ]);
    }

    public function test_deleteFlight(): void
    {
        $airplane = Airplane::factory(10)->create();
        $flight = Flight::factory()->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $user->update(["admin" => 1]);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->delete(route("apiflightdestroy", $flight->id));

        $response->assertStatus(200);
        $this->assertDatabaseCount("flights", 0);
    }
}
