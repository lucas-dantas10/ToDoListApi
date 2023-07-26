<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::where('iduser', auth()->user()->id)   
            ->with('category')
            ->orderBy('title', 'desc')
            ->get();

        return \response([
            'tasks' =>  TaskResource::collection($tasks)
        ]);
    }

    public function filterByDate(Request $request) 
    {
        $dateRequest = $request->validate([
            'date' => 'nullable|date_format:Y-m-d'
        ]);

        $tasks = Tasks::query();

        $currentDate = Carbon::now()->toDateString();
        $subDate = Carbon::now()->subDay()->toDateString();

        if ($dateRequest['date'] === $currentDate) {
            $data = $tasks->where('dtInicio', 'like', "%{$currentDate}%")->with('category')->get();

            if ($this->notTaskInDay($data)) {
                return \response([
                    'message' => 'Você não tem tarefa no dia selecionado'
                ], 422);
            }

            return \response([
                'tasks' => TaskResource::collection($data)
            ]);
        }

        if ($dateRequest['date'] === $subDate) {
            $data = $tasks->where('dtInicio', 'like', "%{$subDate}%")->get();

            if ($this->notTaskInDay($data)) {
                return \response([
                    'message' => 'Você não tem tarefa no dia selecionado'
                ], 422);
            }

            return response([
                'tasks' => TaskResource::collection($data)
            ]);
        }
    }

    public function filterByName(Request $request)
    {
        $data = $request->validate([
            'taskSearch' => ['max:150']
        ]);

        $titleTask = $data['taskSearch'];

        $query = Tasks::query()
            ->where("title", "like", "%{$titleTask}%")
            ->get();

        if (is_null($query)) {
            return response([
                'message' => 'Não existe tarefa com esse nome'
            ], 422);
        }

        return response([
            'tasks' => TaskResource::collection($query)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = $request->validated();
        $tasks = Tasks::firstOrCreate([
            'title' => $task['title'],
            'dtInicio' => $task['date'],
        ], [
            'title' => $task['title'],
            'description' => $task['description'],
            'dtInicio' => $task['date'],
            'iduser' => auth()->user()->id,
            'status_task' => false,
            'idcategory' => $task['category']['id'],
            'created_at' => Carbon::now()
        ]);

        $result = $tasks->with('category')->get();

        if (!$tasks->wasRecentlyCreated) {
            return response([
                'message' => 'Esta Tarefa ja existe'
            ], 422);
        }

        return \response([
            'message' => 'Tarefa Criada',
            'task' => TaskResource::collection($result)
        ]);
    }


    private function notTaskInDay(Collection $date)
    {
        if (sizeof($date) == 0) {
            return true;
        } else {
            return \false;
        }
        
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        \dd('oi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
