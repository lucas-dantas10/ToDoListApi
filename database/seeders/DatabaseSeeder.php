<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tasks;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'lucas',
            'email' => 'lucas@example.com',
            'password' => \bcrypt('123456')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'teste',
            'email' => 'teste@example.com',
            'password' => \bcrypt('123456')
        ]);

        Tasks::factory(1)->create();

        Category::factory(3)->create();
    }
}
