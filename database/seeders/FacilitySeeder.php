<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Facility::truncate();

        $facilities = [
            [
                'name'        => 'Perpustakaan',
                'slug'        => 'perpustakaan',
                'description' => 'Perpustakaan lengkap dengan ribuan koleksi buku pelajaran, buku cerita, dan ensiklopedia untuk mendukung minat baca dan pembelajaran siswa.',
                'icon'        => 'fas fa-book-open',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Laboratorium Komputer',
                'slug'        => 'laboratorium-komputer',
                'description' => 'Laboratorium komputer dengan 30 unit komputer berspesifikasi terkini untuk mendukung pembelajaran teknologi informasi dan komunikasi.',
                'icon'        => 'fas fa-desktop',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Lapangan Olahraga',
                'slug'        => 'lapangan-olahraga',
                'description' => 'Lapangan olahraga serbaguna yang luas untuk berbagai kegiatan olahraga, upacara bendera, dan kegiatan ekstrakurikuler.',
                'icon'        => 'fas fa-running',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Kantin Sekolah',
                'slug'        => 'kantin-sekolah',
                'description' => 'Kantin bersih dan sehat yang menyediakan makanan bergizi untuk siswa dan guru dengan harga terjangkau.',
                'icon'        => 'fas fa-utensils',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Ruang UKS',
                'slug'        => 'ruang-uks',
                'description' => 'Ruang Unit Kesehatan Sekolah yang dilengkapi dengan peralatan medis dasar dan tenaga kesehatan untuk menjaga kesehatan siswa.',
                'icon'        => 'fas fa-first-aid',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Aula Serbaguna',
                'slug'        => 'aula-serbaguna',
                'description' => 'Aula serbaguna berkapasitas 300 orang untuk kegiatan pentas seni, seminar, pertemuan orang tua, dan acara sekolah lainnya.',
                'icon'        => 'fas fa-chalkboard',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Masjid / Mushola',
                'slug'        => 'mushola',
                'description' => 'Mushola sekolah yang nyaman untuk kegiatan sholat berjamaah dan pembinaan keagamaan siswa sehari-hari.',
                'icon'        => 'fas fa-mosque',
                'kondisi'     => 'tersedia',
            ],
            [
                'name'        => 'Ruang Kelas',
                'slug'        => 'ruang-kelas',
                'description' => '18 ruang kelas yang nyaman, bersih, dan dilengkapi dengan papan tulis, proyektor, dan fasilitas belajar modern.',
                'icon'        => 'fas fa-door-open',
                'kondisi'     => 'tersedia',
            ],
        ];

        foreach ($facilities as $data) {
            Facility::create($data);
        }
    }
}