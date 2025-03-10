<?php

namespace Tests\Feature;

use App\Models\Airplane;
use Tests\TestCase;
use App\Models\User;
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
        Airplane::factory()->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->post(route("planesCreate", [
            "id" => 1,
            "name" => "test",
            "max_places" => 200
        ]));

        $response->assertStatus(302)->assertRedirect(route("planes"));
    }
}
