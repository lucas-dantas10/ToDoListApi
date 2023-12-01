<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Enums\ScheduleType;
use App\Helper\VerifyTaskOfDay;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Tasks;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page', 5);
        $search = request('search', '');
        $sortField = request('sort_field', 'title');
        $sortDirection = request('sort_direction', 'desc');
        $status = request('status', 0);
        $priority = request('priority', 0);

        $query = Tasks::with(['category', 'status', 'priority', 'schedule'])
            ->orderBy($sortField, $sortDirection)
            ->where('iduser', auth()->user()->id)
            ->where('title', 'like', "%{$search}%");  

        if ($status != 0 || $priority != 0) {
            $query->where(function ($query) use ($status, $priority) {
                if ($status != 0) {
                    $query->where('status_id', $status);
                }
        
                if ($priority != 0) {
                    $query->where('priority_id', $priority);
                }
            });
        }

        if (!VerifyTaskOfDay::isBusinessDay()) {
            $query->where('schedule_id', ScheduleType::everyday->value);
        }
            
        $paginator = $query->paginate($perPage); 

        return TaskResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $taskForRegister = $request->validated();

        $task = Tasks::firstOrCreate([
            'title' => $taskForRegister['title'],
        ], [
            'title' => $taskForRegister['title'],
            'description' => $taskForRegister['description'],
            'iduser' => auth()->user()->id,
            'status_id' => $taskForRegister['status'],
            'priority_id' => $taskForRegister['priority'],
            'schedule_id' => $taskForRegister['schedule'],
            'idcategory' => $taskForRegister['category'],
            'created_at' => Carbon::now()
        ]);

        if (!$task->wasRecentlyCreated) {
            return response([
                'message' => 'Esta Tarefa ja existe'
            ], 422);
        }

        return \response([
            'message' => 'Tarefa Criada',
        ]);
    }


     /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, int $id)
    {
        $data = $request->validated();
        $task = Tasks::findOrFail($id);

        $task->update([
            "title" => $data['title'],
            "description" => $data['description'],
            "idcategory" => $data['category']["id"],
            "status_id" => $data["status"]["id"],
            "priority_id" => $data["priority"]["id"],
            "updated_at" => Carbon::now(),
        ]);

        return response([
            'message' => 'Tarefa Atualizada',
            'task' => new TaskResource($task)
        ]);
    }


     /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();

        return response([
            'message' => 'Tarefa deletada'
        ]);
    }
}
