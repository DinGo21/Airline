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

        Airplane::factory(10)->create();
        Flight::factory(10)->create();
        $response = $this->get(route("index"));

        $response->assertStatus(200)->assertViewIs("index");
    }

    // public function test_viewsIsShow(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create();
    //     Flight::factory()->create(["airplane_id" => 1]);
    //     $response = $this->get(route("show", 1));

    //     $response->assertStatus(200)->assertViewIs("show");
    // }

    // public function test_unauthenticatedActionRequest(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create();
    //     Flight::factory()->create(["airplane_id" => 1]);
    //     $response = $this->get(route("show", 
    //         [
    //             "id" => 1,
    //             "action" => "book"
    //         ]
    //     ));

    //     $response->assertRedirect(route("show", 1));
    // }

    // public function test_bookFlight(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create(["places" => 1]);
    //     Flight::factory()->create(["airplane_id" => 1, "status" => 1]);
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
    //     $this->assertInstanceOf(BelongsToMany::class, $user->flights());
    //     $this->assertEquals($flight->airplane->places, 0);
    //     $this->assertEquals($flight->status, 0);
    //     $response->assertRedirect(route("show", 1));
    // }

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

    // public function test_debookFlight(): void
    // {
    //     $this->withoutExceptionHandling();

    //     Airplane::factory()->create(["places" => 0]);
    //     $flight = Flight::factory()->create(["airplane_id" => 1, "status" => 0]);
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
    //     $this->assertEquals($flight->airplane->places, 1);
    //     $this->assertEquals($flight->status, 1);
    //     $response->assertRedirect(route("show", 1));
    // } 

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

