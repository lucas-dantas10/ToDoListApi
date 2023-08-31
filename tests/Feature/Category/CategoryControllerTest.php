<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_should_be_return_all_categories_of_user_logged(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/category');

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $response['data']
        ]);
    }

    public function test_should_be_store_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/category', [
            'name' => 'work',
            'icon' => 'briefcase', 
            'color' => '#FFFFFF'
        ]);

        $categoryForTest = Category::find($response['category']['id']);

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJson([
            'category' => $response['category'],
            'message' => 'Categoria criada!'
        ]);
        $categoryForTest->delete();
    }

    public function test_should_be_return_message_of_category_already_exist(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/category', [
            'name' => 'Trabalho',
            'icon' => 'briefcase', 
            'color' => '#FFFFFF'
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'Você ja possui esta categoria'
        ]);
    }
}
