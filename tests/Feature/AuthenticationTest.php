<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $user = new User([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password' => Hash::make('123456'),
        ]);

        $user->save();
    }

    /** @test ** */
    public function it_will_register_a_user()
    {
        $response = $this->post('api/register', [
            'name' => 'Another Test User',
            'email' => 'test2@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test ** */
    public function it_will_log_a_user_in()
    {
        $response = $this->post('api/login', [
            'email' => 'test@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test ** */
    public function it_will_not_log_an_invalid_user_in()
    {
        $response = $this->post('api/login', [
            'email' => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertStatus(401);
    }

}
