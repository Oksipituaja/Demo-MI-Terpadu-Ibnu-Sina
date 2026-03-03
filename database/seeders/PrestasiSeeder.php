<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestasis = [
            [
                'title' => 'Juara 1 Lomba Matematika Tingkat Kabupaten',
                'slug' => 'juara-1-lomba-matematika-tingkat-kabupaten',
                'description' => 'Siswa SD Bangsri berhasil meraih prestasi gemilang dengan menjadi juara 1 dalam lomba matematika tingkat kabupaten. Prestasi ini menunjukkan dedikasi dan kerja keras dalam pembelajaran matematika.',
                'category' => 'Academic',
                'achievement_date' => now()->subMonths(3),
                'status' => 'published',
            ],
            [
                'title' => 'Medali Emas Lomba Olahraga Lari 100m',
                'slug' => 'medali-emas-lomba-olahraga-lari-100m',
                'description' => 'Prestasi gemilang dalam lomba olahraga tingkat provinsi. Siswa kami berhasil meraih medali emas dalam nomor lari 100m dengan waktu yang sangat kompetitif.',
                'category' => 'Sports',
                'achievement_date' => now()->subMonths(2),
                'status' => 'published',
            ],
            [
                'title' => 'Juara Festival Seni Rupa Sekolah Dasar',
                'slug' => 'juara-festival-seni-rupa-sekolah-dasar',
                'description' => 'Karya seni visual siswa kami berhasil memenangkan juara pertama dalam festival seni rupa antar sekolah dasar se-kabupaten. Ini menunjukkan kreativitas dan bakat seni yang luar biasa.',
                'category' => 'Arts',
                'achievement_date' => now()->subMonth(),
                'status' => 'published',
            ],
            [
                'title' => 'Penghargaan Akreditasi A dari BAN',
                'slug' => 'penghargaan-akreditasi-a-dari-ban',
                'description' => 'SD Bangsri dengan bangga mengumumkan bahwa sekolah kami telah meraih akreditasi A dari Badan Akreditasi Nasional (BAN). Ini adalah bukti komitmen kami terhadap kualitas pendidikan.',
                'category' => 'Academic',
                'achievement_date' => now()->subWeeks(2),
                'status' => 'published',
            ],
            [
                'title' => 'Pemenang Kompetisi Coding Remaja Indonesia',
                'slug' => 'pemenang-kompetisi-coding-remaja-indonesia',
                'description' => 'Dua siswa kami berhasil menjadi pemenang dalam kompetisi coding remaja Indonesia 2026. Mereka menampilkan inovasi dan kemampuan problem-solving yang mengesankan.',
                'category' => 'Technology',
                'achievement_date' => now()->subWeeks(3),
                'status' => 'published',
            ],
        ];

        foreach ($prestasis as $prestasi) {
            Prestasi::create($prestasi);
        }
    }
}
