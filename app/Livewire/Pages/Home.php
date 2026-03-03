<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\Agenda;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Teacher;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public function render()
    {
        // Mengambil berita terbaru yang sudah dipublikasikan
        $latestNews = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Mengambil galeri secara acak untuk variasi visual di homepage
        $galleries = Gallery::inRandomOrder()->limit(6)->get();

        // Mengambil semua fasilitas
        $facilities = Facility::all();

        // Mengambil data guru (limit 3)
        $teachers = Teacher::limit(3)->get();

        /**
         * PERBAIKAN AGENDA:
         * 1. Filter status sesuai ENUM baru (upcoming & ongoing).
         * 2. Prioritaskan agenda terdepan (tanggal >= hari ini).
         * 3. Urutkan berdasarkan tanggal terdekat.
         */
        $today = Carbon::today();
        $agendas = Agenda::whereIn('status', ['upcoming', 'ongoing'])
            ->orderByRaw('
                CASE WHEN event_date >= ? THEN 0 ELSE 1 END,
                CASE WHEN event_date >= ? THEN event_date ELSE NULL END ASC,
                event_date DESC
            ', [$today, $today])
            ->limit(4)
            ->get();

        // Mengambil sambutan kepala sekolah dari tabel settings/about
        $principalGreeting = About::where('key', 'principal_greeting')->first();

        // Mengambil hero image dari database
        $heroImage = About::where('key', 'hero_image')->first();

        return view('livewire.pages.home', [
            'latestNews' => $latestNews,
            'galleries' => $galleries,
            'facilities' => $facilities,
            'teachers' => $teachers,
            'agendas' => $agendas,
            'principalGreeting' => $principalGreeting,
            'heroImage' => $heroImage,
        ]);
    }
}
