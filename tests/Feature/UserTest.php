<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_viewIsBookings(): void
    {
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->get(route("userBookings"));

        $response->assertStatus(200)->assertViewIs("bookings");
    }

    public function test_debookFlight(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create(["max_places" => 1]);
        $flight = Flight::factory()->create(["date" => "2050-01-01", "status" => 1]);
        $user = User::factory()->create();
        $this->be($user);
        $flight->users()->attach(1);
        $flight->update(["available_places" => $flight->airplane->max_places - 1]);
        $response = $this->get(route("userBookings", [
            "action" => "debook",
            "id" => 1
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertEquals($flight->airplane->max_places, $flight->available_places);
        $response->assertStatus(302)->assertRedirect(route("userBookings"));
    }

    public function test_denegateDebookAction(): void
    {
        Airplane::factory(10)->create(["max_places" => 1]);
        $flight = Flight::factory()->create(["date" => "0000-00-00", "status" => 0]);
        $user = User::factory()->create();
        $this->be($user);
        $flight->users()->attach(1);
        $flight->update(["available_places" => $flight->airplane->max_places - 1]);
        $response = $this->get(route("userBookings", [
            "action" => "debook",
            "id" => 1
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertEquals($flight->airplane->max_places - 1, $flight->available_places);
        $response->assertStatus(302)->assertRedirect(route("userBookings"));
    }

    public function test_viewIsUsers(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("users"));

        $response->assertStatus(200)->assertViewIs("admin.users.users");
    }

    public function test_denegateAccessToAdminPanels(): void
    {
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->get(route("users"));

        $response->assertStatus(401)->assertJsonFragment(["message" => "User is not an administrator"]);
    }
}
