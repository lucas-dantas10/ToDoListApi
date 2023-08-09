<?php

namespace Tests\Feature\Task;

use App\Models\Tasks;
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

    public function test_return_filter_of_tasks_at_today_in_array_if_have_not_task_return_message(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->toDateString(),
        ]);

        if (isset($response['message'])) {
            $response->assertStatus(422);
            return;
        }

        $response->assertStatus(200);
        $this->assertIsArray($response['tasks']);
    }

    public function test_return_filter_of_tasks_with_name_in_array_if_have_not_tasks_return_message(): void 
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/tasks/filter/name', [
            'taskSearch' => 'Teste'
        ]);

        if (isset($response['message'])) {
            $response->assertStatus(422);
            return;
        }

        $response->assertStatus(200);
        $this->assertIsArray($response['tasks']);
    }

    public function test_store_task_and_return_task_in_array_if_exist_task_return_message(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/task', [
            'title' => 'Test TDD',
            'description' => 'testando store',
            'date' => Carbon::now()->format("Y-m-d H:i:s"),
            'category' => [
                'id' => 1,
                'name' => 'Trabalho',
                'icon' => 'briefcase',
                'color' => '#FF9680' 
            ],
        ]);

        if (isset($response['message']) && !isset($response['task'])) {
            $response->assertStatus(422);
            return;
        }

        $response->assertStatus(200);
        $this->assertIsArray($response['task']);
    }

    public function test_update_task(): void
    {
        $this->do_login_user_for_get_token();

        $task = Tasks::all();

        $response = $this->put("/api/task/{$task[0]->id}", [
            'id' => 1,
            'title' => 'Test TDD',
            'description' => 'testando update',
            'date' => Carbon::now()->format("Y-m-d H:i:s"),
            'id_category' => 1,
            'status' => false,
            'name_category' => 'Trabalho',
            'icon_category' => 'briefcase',
            'color_category' => '#FF9680' 
        ]);

        $response->assertStatus(200);
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
