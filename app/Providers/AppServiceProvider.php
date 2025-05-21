<?php

namespace App\Providers;

use App\Events\Registered;
use Illuminate\Support\ServiceProvider;
use App\Listeners\CreateDefaultCategories;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            CreateDefaultCategories::class,
        ],
    ];

    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
