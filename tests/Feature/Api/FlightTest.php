<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Airplane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAllFlights(): void
    {
        Airplane::factory(10)->create();
        Flight::factory(10)->create();
        $response = $this->get(route("apiflightindex"));

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function test_getOneFlight(): void
    {
        Airplane::factory()->create();
        Flight::factory()->create(["airplane_id" => 1]);

        $response = $this->get(route("apiflightshow", 1));

        $response->assertStatus(200)->assertJsonFragment(["id" => 1]);
    }

    public function test_createFlight(): void
    {
        Airplane::factory()->create();
        $response = $this->post(route("apiflightstore"),
            [
                "date" => "2025-12-12",
                "departure" => "testdeparture",
                "arrival"  => "testarrival",
                "image" => "img/test.jpg",
                "airplaneId" => 1,
                "status" => 0
            ]
        );

        $this->assertDatabaseCount("flights", 1);
        $response->assertStatus(200)->assertJsonFragment(
            [
                "date" => "2025-12-12",
                "departure" => "testdeparture",
                "arrival"  => "testarrival",
                "image" => "img/test.jpg",
                "airplane_id" => 1,
                "status" => 1
            ]
        );
    }

    public function test_updateFlight(): void
    {
        Airplane::factory()->create();
        Flight::factory()->create(["airplane_id" => 1]);
        $response = $this->put(route("apiflightupdate", 1),
            [
                "date" => "2025-12-12",
                "departure" => "testdeparture",
                "arrival"  => "testarrival",
                "image" => "img/test.jpg",
                "airplaneId" => 1,
                "status" => 0
            ]
        );

        $response->assertStatus(200)->assertJsonFragment(
            [
                "date" => "2025-12-12",
                "departure" => "testdeparture",
                "arrival"  => "testarrival",
                "image" => "img/test.jpg",
                "airplane_id" => 1,
                "status" => 1
            ]
        );
    }

    public function test_deleteOneFlight(): void
    {
        Airplane::factory()->create();
        Flight::factory()->create(["airplane_id" => 1]);
        $response = $this->delete(route("apiflightdestroy", 1));

        $response->assertStatus(200);
        $this->assertDatabaseCount("flights", 0);
    }
}
