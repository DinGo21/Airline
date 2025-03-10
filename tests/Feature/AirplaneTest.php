<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirplaneTest extends TestCase
{
    use RefreshDatabase;

    public function test_viewIsAirplanes(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("planes"));

        $response->assertStatus(200)->assertViewIs("admin.airplanes.airplanes");
    }

    public function test_deleteAirplane(): void
    {
        Airplane::factory()->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("planes", ["action" => "delete", "id" => 1]));

        $response->assertStatus(302)->assertRedirect(route("planes"));
        $this->assertDatabaseCount("airplanes", 0);
    }

    public function test_viewIsAirplanesCreate(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("planesCreate"));

        $response->assertStatus(200)->assertViewIs("admin.airplanes.airplanesCreate");
    }

    public function test_createAirplane(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->post(route("planesCreate", [
            "name" => "test",
            "max_places" => 200
        ]));

        $response->assertStatus(302)->assertRedirect(route("planes"));
        $this->assertDatabaseCount("airplanes", 1);
    }

    public function test_viewIsAirplanesedit(): void
    {
        Airplane::factory()->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("planesEdit", 1));

        $response->assertStatus(200)->assertViewIs("admin.airplanes.airplanesEdit");
    }

    public function test_editAirplane(): void
    {
        $airplane = Airplane::factory()->create(["max_places" => 150]);
        Flight::create([
            "date" => "2025-05-05",
            "departure" => "test",
            "arrival" => "test",
            "image" => "test",
            "airplane_id" => $airplane->id,
            "available_places" => $airplane->max_places,
            "status" => 1
        ]);
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->post(route("planesEdit", [
            "id" => 1,
            "name" => "test",
            "max_places" => 100
        ]));

        $response->assertStatus(302)->assertRedirect(route("planes"));
    }
}
