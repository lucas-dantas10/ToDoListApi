<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_login_not_exist(): void
    {
        $response = $this->post('/api/create-account', [
            'name' => 'teste',
            'email' => 'teste@example.com',
            'password' => '12345678',
            'confirmPassword' => '12345678'
        ]);

        $response->assertStatus(200);
    }

    public function test_create_login_exist(): void 
    {
        $response = $this->post('/api/create-account', [
            'name' => 'lucas',
            'email' => 'ted45@example.org',
            'password' => '12345678',
            'confirmPassword' => '12345678'
        ]);

        $response->assertStatus(200);
    }
}
