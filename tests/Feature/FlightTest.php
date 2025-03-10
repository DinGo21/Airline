<?php

namespace Tests\Feature;

use App\Models\Airplane;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_viewIsIndex(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route("index"));

        $response->assertStatus(200)->assertViewIs("index");
    }

    public function test_viewIsSearch(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route("search", [
            "departure" => "test",
            "arrival" => "test",
            "date" => "0000-00-00"
        ]));

        $response->assertStatus(200)->assertViewIs("search");
    }

    public function test_searchRedirectsToIndex(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route("search"));

        $response->assertStatus(302)->assertRedirect(route("index"));
    }

    public function test_viewsIsShow(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create();
        Flight::factory()->create();
        $response = $this->get(route("show", 1));

        $response->assertStatus(200)->assertViewIs("show");
    }

    public function test_unauthenticatedActionRequest(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create();
        Flight::factory()->create();
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "book"
        ]));

        $response->assertStatus(302)->assertRedirect(route("index"));
    }

    public function test_bookFlight(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create(["max_places" => 100]);
        Flight::factory()->create(["date" => "2050-01-01", "status" => 1]);
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "book"
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertInstanceOf(BelongsToMany::class, $user->flights());
        $this->assertEquals($flight->airplane->max_places - 1, $flight->available_places);
        $response->assertStatus(302)->assertRedirect(route("show", 1));
    }

    public function test_denegateBookAction(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create(["max_places" => 0]);
        Flight::factory()->create();
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "book"
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $response->assertStatus(302)->assertRedirect(route("show", 1));
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
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "debook"
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertEquals($flight->airplane->max_places, $flight->available_places);
        $response->assertStatus(302)->assertRedirect(route("show", 1));
    } 

    public function test_denegateDebookAction(): void
    {
        Airplane::factory(10)->create(["max_places" => 1]);
        $flight = Flight::factory()->create(["date" => "0000-00-00", "status" => 0]);
        $user = User::factory()->create();
        $this->be($user);
        $flight->users()->attach(1);
        $flight->update(["available_places" => $flight->airplane->max_places - 1]);
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "debook"
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertEquals($flight->airplane->max_places - 1, $flight->available_places);
        $response->assertStatus(302)->assertRedirect(route("show", 1));
    }

    public function test_viewIsFlights(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("flights"));

        $response->assertStatus(200)->assertViewIs("admin.flights.flights");
    }

    public function test_deleteFlight(): void
    {
        Airplane::factory(10)->create();
        Flight::factory(1)->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("flights", ["action" => "delete", "id" => 1]));

        $response->assertStatus(302)->assertRedirect(route("flights"));
        $this->assertDatabaseCount("flights", 0);
    }

    public function test_viewIsFlightsCreate(): void
    {
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("flightsCreate"));

        $response->assertStatus(200)->assertViewIs("admin.flights.flightsCreate");
    }

    public function test_createFlight(): void
    {
        Airplane::factory(10)->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->post(route("flightsCreate", [
            "date" => "2025-12-12",
            "departure" => "test",
            "arrival" => "test",
            "image" => "test",
            "airplane" => 1,
            "status" => 1
        ]));

        $response->assertStatus(302)->assertRedirect(route("flights"));
        $this->assertDatabaseCount("flights", 1);
    }

    public function test_viewIsFlightsEdit(): void
    {
        Airplane::factory(10)->create();
        Flight::factory(1)->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->get(route("flightsEdit", 1));

        $response->assertStatus(200)->assertViewIs("admin.flights.flightsEdit");
    }

    public function test_editFlight(): void
    {
        Airplane::factory(10)->create();
        Flight::factory(1)->create();
        $user = User::factory()->create(["admin" => 1]);
        $this->be($user);
        $response = $this->post(route("flightsEdit", [
            "id" => 1,
            "date" => "2025-12-12",
            "departure" => "test",
            "arrival" => "test",
            "image" => "test",
            "airplane" => 1,
            "status" => 1
        ]));
        $flight = Flight::find(1);

        $response->assertStatus(302)->assertRedirect(route("flights"));
    }
}

