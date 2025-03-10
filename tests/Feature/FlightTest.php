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
        Flight::factory()->create(["status" => 1]);
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

    // public function test_BookWithEmptyPlaces(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create(["places" => 0]);
    //     Flight::factory()->create(["airplane_id" => 1, "status" => 0]);
    //     $user = User::factory()->create();
    //     $this->be($user);
    //     $response = $this->get(route("show", 
    //         [
    //             "id" => 1,
    //             "action" => "book"
    //         ]
    //     ));
    //     $flight = Flight::find(1);

    //     $this->assertAuthenticated();
    //     $this->assertEquals($flight->airplane->places, 0);
    //     $this->assertEquals($flight->status, 0);
    //     $response->assertRedirect(route("show", 1));
    // }

    public function test_debookFlight(): void
    {
        $this->withoutExceptionHandling();

        Airplane::factory(10)->create();
        $flight = Flight::factory()->create();
        $user = User::factory()->create();
        $flight->users()->attach(1);
        $this->be($user);
        $response = $this->get(route("show", [
            "id" => 1,
            "action" => "debook"
        ]));
        $flight = Flight::find(1);

        $this->assertAuthenticated();
        $this->assertEquals($flight->airplane->max_places + 1, $flight->available_places);
        $response->assertRedirect(route("show", 1));
    } 

    // public function test_debookWithFullPlaces(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create(["places" => 200]);
    //     $flight = Flight::factory()->create(["airplane_id" => 1, "status" => 1]);
    //     $user = User::factory()->create();
    //     $flight->users()->attach(1);
    //     $this->be($user);
    //     $response = $this->get(route("show", 
    //         [
    //             "id" => 1,
    //             "action" => "debook"
    //         ]
    //     ));
    //     $flight = Flight::find(1);

    //     $this->assertAuthenticated();
    //     $this->assertEquals($flight->airplane->places, 200);
    //     $this->assertEquals($flight->status, 1);
    //     $response->assertRedirect(route("show", 1));
    // } 
}

