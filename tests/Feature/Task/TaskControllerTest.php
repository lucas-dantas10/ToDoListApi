<?php

namespace Tests\Feature\Task;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_return_of_all_tasks_with_status_active_in_array(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->get('/api/task');

        $response->assertStatus(200);
        $this->assertIsArray($response['tasks']);
    }

    public function test_return_filter_of_tasks_at_today_in_array(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->toDateString(),
        ]);

        $response->assertStatus(200);
        $this->assertIsArray($response['tasks']);
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
