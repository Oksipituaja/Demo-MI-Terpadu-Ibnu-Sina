<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS in production
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        // Override storage URL untuk Railway (no symlink workaround)
        if (app()->isProduction() && !is_link(public_path('storage'))) {
            config(['filesystems.disks.public.url' => config('app.url') . '/files']);
        }

        // Prevent N+1 query issues
        Model::preventLazyLoading(! app()->isProduction());

        // Log queries hanya di development untuk debugging
        if (app()->isLocal()) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
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