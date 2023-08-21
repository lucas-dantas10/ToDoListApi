<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_should_be_store_the_user(): void
    {
        $response = $this->post('/api/create-account', [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => '12345678',
            'confirmPassword' => '12345678'
        ]);

        $response->assertJson([
            'message' => 'Usuário cadastrado'
        ]);
        $response->assertStatus(200);
    }

    public function test_should_be_return_message_of_email_already_utilize(): void 
    {
        // $userTest = User::create([
        //     'name' => 'Teste',
        //     'email' => 'teste@example.com',
        //     'password' => '12345678'
        // ]);

        $response = $this->post('/api/create-account', [
            'name' => 'teste',
            'email' => 'teste@example.com',
            'password' => '12345678',
            'confirmPassword' => '12345678'
        ]);

        $response->assertJson([
            'message' => 'Email já está sendo utilizado'
        ]);
        $response->assertStatus(422);
    }
}
