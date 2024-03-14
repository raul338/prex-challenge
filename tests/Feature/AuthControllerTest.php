<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin(): void
    {
        $user = User::factory()->create();
        $this->postJson(route('api.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('token')
                ->etc()
            );
    }

    public function testInvalidLogin(): void
    {
        $this->postJson(route('api.login'), [
            'email' => fake()->email(),
            'password' => 'password',
        ])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
