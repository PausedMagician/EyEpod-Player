<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        // Check if he can fetch some data
        $response = $this->get('/songs/get');
        $response->assertStatus(200);
    }
}
