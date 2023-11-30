<?php

namespace Tests\Feature\PriorityController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriorityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_priority_in_array(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/priority');

        $response->assertStatus(200);
        $response->assertJsonIsArray();
    }
}
