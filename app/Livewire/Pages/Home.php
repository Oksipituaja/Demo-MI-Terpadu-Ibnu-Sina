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
    /**
     * Helper internal untuk menentukan icon prestasi
     */
    private function getAwardIcon($category)
    {
        $cat = strtolower($category);
        if (str_contains($cat, '1')) {
            return ['icon' => 'fas fa-trophy', 'bgStyle' => 'background:linear-gradient(135deg,#f59e0b,#d97706)', 'textStyle' => 'color:#d97706'];
        } elseif (str_contains($cat, '2')) {
            return ['icon' => 'fas fa-medal', 'bgStyle' => 'background:linear-gradient(135deg,#94a3b8,#475569)', 'textStyle' => 'color:#475569'];
        } elseif (str_contains($cat, '3')) {
            return ['icon' => 'fas fa-award', 'bgStyle' => 'background:linear-gradient(135deg,#b45309,#78350f)', 'textStyle' => 'color:#78350f'];
        }
        return ['icon' => 'fas fa-star', 'bgStyle' => 'background:linear-gradient(135deg,#10b981,#059669)', 'textStyle' => 'color:#059669'];
    }

    public function render()
    {
        $latestNews = Cache::remember('home.latest_news', 1800, function () {
            return News::where('status', 'published')
                ->select(['id', 'title', 'slug', 'excerpt', 'published_at', 'featured_image'])
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        $galleries = Cache::remember('home.random_galleries', 1800, function () {
            return Gallery::select(['id', 'title', 'slug', 'featured_image', 'category'])
                ->inRandomOrder()
                ->limit(6)
                ->get();
        });

        $facilities = Cache::remember('home.all_facilities', 3600, function () {
            return Facility::select(['id', 'name', 'slug', 'description', 'featured_image', 'icon'])
                ->get();
        });

        $teachers = Cache::remember('home.featured_teachers', 3600, function () {
            return Teacher::select(['id', 'name', 'subject', 'featured_image', 'slug'])
                ->limit(3)
                ->get();
        });

        $today = Carbon::today();
        $agendas = Cache::remember('home.upcoming_agendas', 900, function () use ($today) {
            return Agenda::select(['id', 'title', 'description', 'event_date', 'event_time', 'location', 'status', 'slug'])
                ->whereIn('status', ['upcoming', 'ongoing'])
                ->orderByRaw('CASE WHEN event_date >= ? THEN 0 ELSE 1 END, event_date ASC', [$today])
                ->limit(4)
                ->get();
        });

        $principalGreeting = Cache::remember('about.principal_greeting', 86400, function () {
            return About::where('key', 'principal_greeting')->first();
        });

        // Diubah menjadi $heroImage agar sinkron dengan Blade
        $heroImage = Cache::remember('about.hero_featured_image', 86400, function () {
            return About::where('key', 'hero_featured_image')->first();
        });

        $prestasis = Cache::remember('home.featured_prestasis', 1800, function () {
            return Prestasi::where('status', 'published')
                ->orderBy('achievement_date', 'desc')
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
            'heroImage' => $heroImage, // <--- SINKRON
            'prestasis' => $prestasis,
            'getAwardIcon' => fn($cat) => $this->getAwardIcon($cat) // Mengirim closure ke blade
        ]);
    }
}
