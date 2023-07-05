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
    public function test_method_login(): void
    {
        $response = $this->post('/api/login', [
            'name' => 'lucas', 
            'password' => '123456'
        ]);

        // $response->dd();

        $response->assertStatus(200);
    }
}
