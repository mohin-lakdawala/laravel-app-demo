<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test ** */
    public function games_are_created_correctly()
    {
        $this->json('POST', '/api/games')
            ->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'player_life' => 100,
                'dragon_life' => 100,
                'user_id' => $this->user->id
            ]);
    }

    /** @test ** */
    public function games_are_updated_correctly()
    {
        $this->json('POST', '/api/games')
            ->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'player_life' => 100,
                'dragon_life' => 100,
                'user_id' => $this->user->id
            ]);
    }

    /** @test ** */
    public function games_are_listed_correctly()
    {
        $games = $this->user->games()->saveMany(Game::factory()->count(5)->make());

        $this->json('GET', '/api/games')
            ->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJsonStructure([
                '*' => [
                    'id', 'started_at', 'finished_at', 'player_life', 'dragon_life', 'formatted_started_at'
                ]
            ]);
    }
}
