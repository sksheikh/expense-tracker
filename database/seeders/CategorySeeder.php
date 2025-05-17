<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Food', 'color' => '#f59e0b', 'user_id' => 1],
            ['name' => 'Transportation', 'color' => '#3b82f6', 'user_id' => 1],
            ['name' => 'Entertainment', 'color' => '#ec4899', 'user_id' => 1],
            ['name' => 'Housing', 'color' => '#10b981', 'user_id' => 1],
            ['name' => 'Utilities', 'color' => '#6366f1', 'user_id' => 1]
        ];

        \App\Models\Category::insert($categories);
    }
}
