<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GifControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSearch(): void
    {
        Http::fake([
            'api.giphy.com/v1/gifs/search*' => Http::response(['success' => true]),
        ]);
        Http::preventStrayRequests();

        $user = User::factory()->create();
        $this->actingAs($user)
            ->getJson(route('api.gif.search', ['query' => fake()->word]))
            ->assertSuccessful();

        Http::assertSentCount(1);
    }

    public function testGetById(): void
    {
        Http::fake([
            'api.giphy.com/v1/gifs/*' => Http::response(['success' => true]),
        ]);
        Http::preventStrayRequests();

        $user = User::factory()->create();
        $this->actingAs($user)
            ->getJson(route('api.gif.show', ['id' => fake()->word]))
            ->assertSuccessful();

        Http::assertSentCount(1);
    }
}
