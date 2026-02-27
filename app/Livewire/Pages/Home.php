<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\Agenda;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Teacher;
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
         * 2. Urutkan berdasarkan tanggal terdekat (asc).
         */
        $agendas = Agenda::whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->limit(4)
            ->get();

        // Mengambil sambutan kepala sekolah dari tabel settings/about
        $principalGreeting = About::where('key', 'principal_greeting')->first();

        return view('livewire.pages.home', [
            'latestNews' => $latestNews,
            'galleries' => $galleries,
            'facilities' => $facilities,
            'teachers' => $teachers,
            'agendas' => $agendas,
            'principalGreeting' => $principalGreeting,
        ]);
    }
}
