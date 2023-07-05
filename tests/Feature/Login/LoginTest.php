<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_method_login_with_login_valid(): void
    {
        $response = $this->post('/api/login', [
            'name' => 'lucas',
            'email' => 'ted45@example.org',
            'password' => '123456'
        ]);

        $response->assertStatus(200);
    }

    public function test_method_login_with_login_not_valid(): void 
    {
        $response = $this->post('/api/login', [
            'name' => 'lucas',
            'email' => 'naoexiste@example.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);
    }
}
