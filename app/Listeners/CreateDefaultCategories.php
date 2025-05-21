<?php

namespace App\Listeners;

use App\Models\Category;
use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultCategories
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        $defaultCategories = [
            ['name' => 'Food', 'color' => '#f59e0b'],
            ['name' => 'Transportation', 'color' => '#3b82f6'],
            ['name' => 'Entertainment', 'color' => '#ec4899'],
            ['name' => 'Housing', 'color' => '#10b981'],
            ['name' => 'Utilities', 'color' => '#6366f1'],
        ];

        foreach ($defaultCategories as $category) {
            Category::create([
                'name' => $category['name'],
                'color' => $category['color'],
                'user_id' => $user->id,
            ]);
        }
    }
}
