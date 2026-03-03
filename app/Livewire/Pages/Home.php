<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\Agenda;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Prestasi;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public function render()
    {
        // Aggressive caching untuk ultra-fast homepage
        $latestNews = Cache::remember('home.latest_news', 1800, function () {
            return News::where('status', 'published')
                ->select(['id', 'title', 'slug', 'excerpt', 'published_at', 'featured_image'])
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        $galleries = Cache::remember('home.random_galleries', 1800, function () {
            return Gallery::select(['id', 'title', 'slug', 'image', 'category'])
                ->inRandomOrder()
                ->limit(6)
                ->get();
        });

        $facilities = Cache::remember('home.all_facilities', 3600, function () {
            return Facility::select(['id', 'name', 'slug', 'description', 'image', 'icon'])
                ->get();
        });

        $teachers = Cache::remember('home.featured_teachers', 3600, function () {
            return Teacher::select(['id', 'name', 'subject', 'image', 'slug'])
                ->limit(3)
                ->get();
        });

        $today = Carbon::today();
        $agendas = Cache::remember('home.upcoming_agendas', 900, function () use ($today) {
            return Agenda::select(['id', 'title', 'description', 'event_date', 'event_time', 'location', 'status', 'slug'])
                ->whereIn('status', ['upcoming', 'ongoing'])
                ->orderByRaw('
                    CASE WHEN event_date >= ? THEN 0 ELSE 1 END,
                    CASE WHEN event_date >= ? THEN event_date ELSE NULL END ASC,
                    event_date DESC
                ', [$today, $today])
                ->limit(4)
                ->get();
        });

        $principalGreeting = Cache::remember('about.principal_greeting', 86400, function () {
            return About::where('key', 'principal_greeting')->select(['id', 'key', 'content'])->first();
        });

        $heroImage = Cache::remember('about.hero_image', 86400, function () {
            return About::where('key', 'hero_image')->select(['id', 'key', 'image'])->first();
        });

        $prestasis = Cache::remember('home.featured_prestasis', 1800, function () {
            return Prestasi::where('status', 'published')
                ->orderByRaw("
                    CASE 
                        WHEN category LIKE '%Juara 1%' THEN 1
                        WHEN category LIKE '%Juara 2%' THEN 2
                        WHEN category LIKE '%Juara 3%' THEN 3
                        WHEN category LIKE '%Harapan 1%' THEN 4
                        WHEN category LIKE '%Harapan 2%' THEN 5
                        WHEN category LIKE '%Harapan 3%' THEN 6
                        WHEN category LIKE '%Harapan%' THEN 7
                        ELSE 99
                    END,
                    achievement_date DESC
                ")
                ->limit(3)
                ->get();
        });

        return view('livewire.pages.home', [
            'latestNews' => $latestNews,
            'galleries' => $galleries,
            'facilities' => $facilities,
            'teachers' => $teachers,
            'agendas' => $agendas,
            'principalGreeting' => $principalGreeting,
            'heroImage' => $heroImage,
            'prestasis' => $prestasis,
        ]);
    }
}
