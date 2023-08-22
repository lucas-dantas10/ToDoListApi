<?php

namespace Database\Factories;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    protected $model = Tasks::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Teste Factory',
            'description' => 'Testando e subindo a factory',
            'dtInicio' => '2022-04-10 10:10:00',
            'status_task' => false,
            'iduser' => 1,
            'idcategory' => 1,
            'created_at' => Carbon::now()
        ];
    }
}
