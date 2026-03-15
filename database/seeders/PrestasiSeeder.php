<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        Prestasi::truncate();

        $prestasis = [
            [
                'title'            => 'Juara 1 Olimpiade Matematika Tingkat Kabupaten',
                'slug'             => 'juara-1-olimpiade-matematika-tingkat-kabupaten',
                'description'      => 'Siswa MI Terpadu Ibnu Sina berhasil meraih Juara 1 dalam Olimpiade Matematika Tingkat Kabupaten. Prestasi ini merupakan hasil dari latihan intensif selama 3 bulan bersama guru pembimbing.',
                'category'         => 'Juara 1',
                'achievement_date' => now()->subMonths(3),
                'status'           => 'published',
            ],
            [
                'title'            => 'Juara 1 Lomba Menyanyi Tunggal Tingkat Kecamatan',
                'slug'             => 'juara-1-lomba-menyanyi-tunggal-tingkat-kecamatan',
                'description'      => 'Salah satu siswa kami berhasil meraih Juara 1 dalam lomba menyanyi tunggal tingkat kecamatan yang diikuti oleh lebih dari 20 peserta dari berbagai sekolah.',
                'category'         => 'Juara 1',
                'achievement_date' => now()->subMonths(2),
                'status'           => 'published',
            ],
            [
                'title'            => 'Juara 2 Lomba Cerdas Cermat Tingkat Kabupaten',
                'slug'             => 'juara-2-lomba-cerdas-cermat-tingkat-kabupaten',
                'description'      => 'Tim cerdas cermat MI Terpadu Ibnu Sina berhasil meraih Juara 2 dalam lomba cerdas cermat antar sekolah dasar tingkat kabupaten tahun ini.',
                'category'         => 'Juara 2',
                'achievement_date' => now()->subMonths(2),
                'status'           => 'published',
            ],
            [
                'title'            => 'Juara 2 Lomba Lari 100m Tingkat Provinsi',
                'slug'             => 'juara-2-lomba-lari-100m-tingkat-provinsi',
                'description'      => 'Atlet muda MI Terpadu Ibnu Sina berhasil meraih Juara 2 dalam lomba lari 100m tingkat provinsi dengan catatan waktu yang membanggakan.',
                'category'         => 'Juara 2',
                'achievement_date' => now()->subMonths(1),
                'status'           => 'published',
            ],
            [
                'title'            => 'Juara 3 Festival Seni Rupa Antar Sekolah Dasar',
                'slug'             => 'juara-3-festival-seni-rupa-antar-sekolah-dasar',
                'description'      => 'Karya seni lukis siswa kami berhasil meraih Juara 3 dalam Festival Seni Rupa Antar Sekolah Dasar se-Kabupaten Jepara.',
                'category'         => 'Juara 3',
                'achievement_date' => now()->subWeeks(3),
                'status'           => 'published',
            ],
            [
                'title'            => 'Harapan 1 Lomba Pidato Bahasa Indonesia',
                'slug'             => 'harapan-1-lomba-pidato-bahasa-indonesia',
                'description'      => 'Siswa MI Terpadu Ibnu Sina meraih Harapan 1 dalam lomba pidato Bahasa Indonesia tingkat kecamatan. Penampilan yang memukau dan penuh percaya diri.',
                'category'         => 'Harapan 1',
                'achievement_date' => now()->subWeeks(2),
                'status'           => 'published',
            ],
            [
                'title'            => 'Harapan 2 Kompetisi Sains Dasar Tingkat Kabupaten',
                'slug'             => 'harapan-2-kompetisi-sains-dasar-tingkat-kabupaten',
                'description'      => 'Tim sains MI Terpadu Ibnu Sina meraih Harapan 2 dalam Kompetisi Sains Dasar Tingkat Kabupaten. Eksperimen yang ditampilkan mendapat pujian dari juri.',
                'category'         => 'Harapan 2',
                'achievement_date' => now()->subWeeks(1),
                'status'           => 'published',
            ],
            [
                'title'            => 'Juara 3 Lomba Mewarnai Tingkat Kecamatan',
                'slug'             => 'juara-3-lomba-mewarnai-tingkat-kecamatan',
                'description'      => 'Siswa kelas 2 MI Terpadu Ibnu Sina meraih Juara 3 dalam lomba mewarnai tingkat kecamatan. Kreativitas dan ketelitian dalam mewarnai menjadi keunggulan.',
                'category'         => 'Juara 3',
                'achievement_date' => now()->subDays(5),
                'status'           => 'published',
            ],
        ];

        foreach ($prestasis as $item) {
            Prestasi::create($item);
        }
    }
}