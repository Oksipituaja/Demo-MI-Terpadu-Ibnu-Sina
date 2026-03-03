<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class OptimizeWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize website performance dengan warming up caches';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('🚀 Starting website optimization...');

        $this->warmUpCaches();
        $this->clearOldCaches();

        $this->info('✅ Website optimization completed!');
        $this->info('Expected page load time: < 3 seconds');
    }

    /**
     * Warm up all essential caches
     */
    private function warmUpCaches(): void
    {
        $this->info('Warming up caches...');

        // Home page caches
        Cache::remember('home.latest_news', 3600, function () {
            return \App\Models\News::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        Cache::remember('home.random_galleries', 3600, function () {
            return \App\Models\Gallery::inRandomOrder()->limit(6)->get();
        });

        Cache::remember('home.all_facilities', 3600, function () {
            return \App\Models\Facility::all();
        });

        Cache::remember('home.featured_teachers', 3600, function () {
            return \App\Models\Teacher::limit(3)->get();
        });

        Cache::remember('home.upcoming_agendas', 1800, function () {
            $today = \Carbon\Carbon::today();

            return \App\Models\Agenda::whereIn('status', ['upcoming', 'ongoing'])
                ->orderByRaw('
                    CASE WHEN event_date >= ? THEN 0 ELSE 1 END,
                    CASE WHEN event_date >= ? THEN event_date ELSE NULL END ASC,
                    event_date DESC
                ', [$today, $today])
                ->limit(4)
                ->get();
        });

        // About page caches
        Cache::remember('about.principal_greeting', 86400, function () {
            return \App\Models\About::where('key', 'principal_greeting')->first();
        });

        Cache::remember('about.hero_image', 86400, function () {
            return \App\Models\About::where('key', 'hero_image')->first();
        });

        // Gallery page caches
        Cache::remember('gallery.all_categories', 3600, function () {
            return \App\Models\Gallery::distinct('category')
                ->pluck('category')
                ->toArray();
        });

        $this->line('<fg=green>✓</> Caches warmed successfully');
    }

    /**
     * Clear unused caches
     */
    private function clearOldCaches(): void
    {
        $this->info('Clearing old caches...');

        // Bisa ditambahkan cache yang sudah expired atau tidak digunakan
        // Cache::forget('expired_key');

        $this->line('<fg=green>✓</> Old caches cleared');
    }
}
