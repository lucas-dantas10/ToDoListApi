<?php

namespace Tests\Feature\Task;

use App\Http\Resources\Task\TaskResource;
use App\Models\Tasks;
use Carbon\Carbon;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_should_be_return_of_all_tasks_with_status_active_in_array(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->get('/api/task');

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $this->assertIsArray($response['tasks']);
    }

    public function test_should_be_filter_of_tasks_at_today(): void
    {
        $this->do_login_user_for_get_token();

        $taskCreatedForTest = Tasks::create([
            'title' => 'Teste Filter Date',
            'description' => 'Teste Filter',
            'dtInicio' =>Carbon::now(),
            'status_task' => false,
            'iduser' => auth()->user()->id,
            'idcategory' => 1,
            'created_at' => Carbon::now()
        ]);

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->toDateString(),
        ]);

        $taskCreatedForTest->delete();

        $response->assertStatus(200);
        $this->assertAuthenticated();
        $this->assertIsArray($response['tasks']);
    }

    public function test_should_be_filter_of_tasks_at_subdate(): void
    {
        $this->do_login_user_for_get_token();

        $taskCreatedForTest = Tasks::create([
            'title' => 'Teste Filter Date',
            'description' => 'Teste Filter',
            'dtInicio' => Carbon::now()->subDay(),
            'status_task' => false,
            'iduser' => auth()->user()->id,
            'idcategory' => 1,
            'created_at' => Carbon::now()
        ]);

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->subDay()->toDateString(),
        ]);

        $taskCreatedForTest->delete();

        $this->assertAuthenticated();
        $response->assertStatus(200);
    }

    public function test_should_be_return_message_that_it_does_not_have_a_task_on_the_today(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->toDateString(),
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'Você não tem tarefa no dia selecionado'
        ]);
    }

    public function test_should_be_return_message_that_it_does_not_have_a_task_on_the_subday(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/tasks/filter', [
            'date' => Carbon::now()->subDay()->toDateString(),
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'Você não tem tarefa no dia selecionado'
        ]);
    }

    public function test_should_be_return_filter_of_tasks_with_name_in_array_if_have_not_tasks_return_message(): void 
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

    public function test_should_be_store_task(): void
    {
        $this->do_login_user_for_get_token();

        $response = $this->post('/api/task', [
            'title' => fake()->name(),
            'description' => 'testando store',
            'date' => '2023-07-15 10:10:00',
            'category' => [
                'id' => 1,
                'name' => 'Trabalho',
                'icon' => 'briefcase',
                'color' => '#FF9680' 
            ],
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Tarefa Criada',
            'task' => $response['task']
        ]);
    }

    public function test_should_be_return_message_of_task_already_exist(): void
    {
        $this->do_login_user_for_get_token();

        Tasks::create([
            'title' => 'Teste Store',
            'description' => 'testando store failed',
            'dtInicio' => '2023-07-15 10:10:00',
            'status_task' => false,
            'iduser' => auth()->user()->id,
            'idcategory' => 1,
            'created_at' => Carbon::now()
        ]);

        $response = $this->post('/api/task', [
            'title' => 'Teste Store',
            'description' => 'testando store failed',
            'date' => '2023-07-15 10:10:00',
            'category' => [
                'id' => 1,
                'name' => 'Trabalho',
                'icon' => 'briefcase',
                'color' => '#FF9680' 
            ],
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'Esta Tarefa ja existe'
        ]);
    }

    public function test_should_be_update_task(): void
    {
        $this->do_login_user_for_get_token();

        $task = Tasks::all();
        $dataRequest = [
            'id' => 1,
            'title' => 'Test Update',
            'description' => 'testando update',
            'date' => Carbon::now()->format("Y-m-d H:i:s"),
            'id_category' => 1,
            'status' => false,
            'name_category' => 'Trabalho',
            'icon_category' => 'briefcase',
            'color_category' => '#FF9680' 
        ];

        $response = $this->put("/api/task/{$task[0]->id}", $dataRequest);

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->json([
            'message' => 'Tarefa Atualizada',
            'task' => new TaskResource($dataRequest)
        ]);
    }

    public function test_should_be_filter_task_by_title(): void 
    {
        $this->do_login_user_for_get_token();

        $taskSearch = [
            'taskSearch' => 'Teste'
        ];

        $response = $this->post('api/tasks/filter/name', $taskSearch);

        $this->assertAuthenticated();
        $this->assertIsArray($response['tasks']);
    }

    public function test_should_return_message_that_does_not_have_a_task_with_his_name(): void
    {
        $this->do_login_user_for_get_token();

        $taskSearch = [
            'taskSearch' => 'Not'
        ];

        $response = $this->post('api/tasks/filter/name', $taskSearch);

        $this->assertAuthenticated();
        $response->assertStatus(422);      
        $response->assertJson([
            'message' => 'Não existe tarefa com esse nome'
        ]);
    }

    public function test_should_be_delete_task(): void
    {
        $this->do_login_user_for_get_token();

        $task = Tasks::all();
        $idTask = $task[0]->id;

        $response = $this->delete("api/task/{$idTask}");

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Tarefa deletada'
        ]);
    }

    public function test_should_be_change_status_of_task(): void
    {
        $this->do_login_user_for_get_token();

        $tasks = Tasks::create([
            'title' => 'Teste Filter Date',
            'description' => 'Teste Filter',
            'dtInicio' => '2022-03-19 10:10:10',
            'status_task' => false,
            'iduser' => auth()->user()->id,
            'idcategory' => 1,
            'created_at' => Carbon::now()
        ]);
        $dataRequest = [
            'id' => $tasks->id,
            'status' => !$tasks->status_task
        ];

        $response = $this->post('api/tasks/change-status', $dataRequest);

        $response->assertNoContent();
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
