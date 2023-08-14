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
            'email' => 'lucas@example.com',
            'password' => \bcrypt('123456')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Desenvolvimento',
            'email' => 'desenvolvimento@example.com',
            'password' => \bcrypt('123456')
        ]);

        Category::factory(3)->create();
    }
}
