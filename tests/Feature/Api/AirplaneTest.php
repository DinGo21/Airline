<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AirplaneTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAllAirplanes(): void
    {
        Airplane::factory(10)->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->get(route("apiairplaneindex"));

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function test_getOneAirplane(): void
    {
        $airplane = Airplane::factory()->create();
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
                            ->get(route("apiairplaneshow", $airplane->id));

        $response->assertStatus(200)->assertJsonFragment(["id" => $airplane->id]);
    }

    public function test_createAirplane(): void
    {
        $credentials = [
            "email" => "test@test.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $user->update(["admin" => 1]);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])
            ->post(route("apiairplanestore"), [
                "name" => "test",
                "maxPlaces" => 200
            ]);

        $response->assertStatus(200)->assertJsonFragment([
            "name" => "test",
            "max_places" => 200
        ]);
    }

    public function test_updateAirplane(): void
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
            ->put(route("apiairplaneupdate", $airplane->id), [
                "name" => "test",
                "maxPlaces" => 200
            ]);

        $response->assertStatus(200)->assertJsonFragment([
            "name" => "test",
            "max_places" => 200
        ]);
    }

    public function test_deleteAirplane(): void
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
            ->delete(route("apiairplanedestroy", $airplane->id));

        $response->assertStatus(200);
        $this->assertDatabaseCount("airplanes", 0);
    }
}
