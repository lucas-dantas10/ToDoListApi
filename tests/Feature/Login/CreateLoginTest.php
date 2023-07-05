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
    public function test_example(): void
    {
        $response = $this->post('/api/create-account', [
            'name' => 'lucas',
            'password' => '123456',
            'confirmPassword' => '123456'
        ]);

        $response->dump();

        $response->assertStatus(200);
    }
}
