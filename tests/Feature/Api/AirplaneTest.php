<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Airplane;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirplaneTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAllAirplanes(): void
    {
        Airplane::factory(10)->create();
        $response = $this->get(route("apiairplaneindex"));

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function test_getOneAirplane(): void
    {
        Airplane::factory()->create();
        $response = $this->get(route("apiairplaneshow", 1));

        $response->assertStatus(200)->assertJsonFragment(["id" => 1]);
        
    }

    public function test_createAirplane(): void
    {
        $response = $this->post(route("apiairplanestore"), 
            [
                "name" => "test",
                "places" => 200
            ]
        );

        $this->assertDatabaseCount("airplanes", 1);
        $response->assertStatus(200)
                    ->assertJsonFragment(
                        [
                            "name" => "test",
                            "places" => 200
                        ]
                    );
    }

    public function test_createAirplaneError(): void
    {
        $response = $this->post(route("apiairplanestore"), 
            [
                "name" => "test",
                "places" => -1
            ]
        );

        $response->assertStatus(400)->assertContent("Incorrect parameters");
    }

    public function test_updateAirplane(): void
    {
        Airplane::factory()->create();
        $response = $this->put(route("apiairplaneupdate", 1), 
            [
                "name" => "test",
                "places" => 200
            ]
        );

        $response->assertStatus(200)->assertJsonFragment(
            [
                "name" => "test",
                "places" => 200
            ]
        );
    }

    public function test_deleteOneAirplane(): void
    {
        Airplane::factory(2)->create();
        $response = $this->delete(route("apiairplanedestroy", 2));

        $response->assertStatus(200);
        $this->assertDatabaseCount("airplanes", 1);
    }

    public function test_airplaneHasRelationship()
    {
        $airplane = Airplane::factory()->create();

        $this->assertInstanceOf(HasMany::class, $airplane->flights());
    }
}
