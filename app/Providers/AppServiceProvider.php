<?php

namespace App\Providers;

use Illuminate\Database\Console\Migrations\FreshCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //DB::prohibitDestructiveCommands($this->app->isProduction());
        //DestructiveCommands::preventFromRunning();
    }
}
