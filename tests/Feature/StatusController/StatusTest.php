<?php

namespace Tests\Feature\StatusController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_status_in_array(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/status');
        
        $response->assertStatus(200); 
        $response->assertJsonIsArray();
    }
}
