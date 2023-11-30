<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Schedule;
use App\Models\Status;
use App\Models\Tasks;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => \bcrypt('user123')
        ]);

        Status::factory()->create(
            [
                'type' => 'Fazer',
                'icon' => 'bi-circle'
            ],
        );

        Status::factory()->create(
            [
                'type' => 'Em progresso',
                'icon' => 'co-clock'
            ],
        );
        
        Status::factory()->create(
            [
                'type' => 'Feito',
                'icon' => 'bi-check-2-circle'
            ],
        );

        Status::factory()->create(
            [
                'type' => 'Cancelado',
                'icon' => 'bi-x-circle'
            ],
        );

        Priority::factory()->create(
            [
                'type' => 'Alta',
                'icon' => 'bi-arrow-up'
            ],
        );

        Priority::factory()->create(
            [
                'type' => 'Baixa',
                'icon' => 'bi-arrow-down'
            ],
        );

        Priority::factory()->create(
            [
                'type' => 'Média',
                'icon' => 'bi-arrow-right'
            ],
        );

        Schedule::factory()->create(
            [
                'type' => 'Segunda a Sexta',
            ],
        );

        Schedule::factory()->create(
            [
                'type' => 'Todos os dias',
            ],
        );

        // Tasks::factory(1)->create();

        // Category::factory(3)->create();
    }
}
