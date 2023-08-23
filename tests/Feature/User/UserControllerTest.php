<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;
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

    public function test_should_be_update_name_and_password_of_user(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->put('/api/user/1', [
            'name' => 'Teste Update User',
            'password' => '12345678'
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Nome e Senha atualizados'
        ]);
    }

    public function test_should_be_return_message_of_name_already_used(): void
    {
        $this->do_login_user_for_get_token();

        // $response = $this->put('/api/user/1', [
        //     'name' => 'Teste Update User',
        // ])
    }

    private function do_login_user_for_get_token()
    {
        $this->post('/api/login', [
            'name' => 'lucas',
            'email' => 'lucas@example.com',
            'password' => '123456'
        ]);
    }
}
