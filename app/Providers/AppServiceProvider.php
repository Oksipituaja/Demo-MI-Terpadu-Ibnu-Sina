<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // Prevent N+1 query issues
        Model::preventLazyLoading(! app()->isProduction());

        // Log queries hanya di development untuk debugging
        if (app()->isLocal()) {
            DB::listen(function ($query) {
                if ($query->time > 100) { // Log queries yang lebih dari 100ms
                    \Log::warning('Slow Query: '.$query->sql.' ('.$query->time.'ms)');
                }
            });
        }

        // Enable query optimization di production
        if (app()->isProduction()) {
            DB::disableQueryLog();
        }
    }
}
