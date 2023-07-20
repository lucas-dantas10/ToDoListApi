<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
            'password' => \bcrypt('123456')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Desenvolvimento',
            'password' => \bcrypt('123456')
        ]);

        Category::factory(3)->create();
    }
}
