<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Gallery::truncate();

        $galleries = [
            [
                'title'       => 'Upacara Bendera Hari Senin',
                'slug'        => 'upacara-bendera-hari-senin',
                'description' => 'Upacara bendera rutin setiap hari Senin pagi yang diikuti seluruh siswa dan guru dengan tertib dan penuh semangat.',
                'category'    => 'Acara Sekolah',
                'image'       => null,
            ],
            [
                'title'       => 'Program Kelas Baca Bersama',
                'slug'        => 'program-kelas-baca-bersama',
                'description' => 'Program membaca bersama di perpustakaan sekolah untuk meningkatkan minat baca dan literasi siswa.',
                'category'    => 'Program Pembelajaran',
                'image'       => null,
            ],
            [
                'title'       => 'Turnamen Olahraga Antar Kelas',
                'slug'        => 'turnamen-olahraga-antar-kelas',
                'description' => 'Turnamen olahraga yang meriah dengan partisipasi dari seluruh kelas dalam rangka memperingati Hari Olahraga Nasional.',
                'category'    => 'Olahraga',
                'image'       => null,
            ],
            [
                'title'       => 'Pameran Karya Seni Siswa',
                'slug'        => 'pameran-karya-seni-siswa',
                'description' => 'Pameran karya seni dan kreativitas siswa yang dipajang di aula sekolah sebagai bentuk apresiasi bakat.',
                'category'    => 'Seni',
                'image'       => null,
            ],
            [
                'title'       => 'Pentas Seni Akhir Tahun',
                'slug'        => 'pentas-seni-akhir-tahun',
                'description' => 'Pertunjukan seni tahunan yang menampilkan berbagai penampilan tari, musik, dan drama oleh siswa SD Bangsri.',
                'category'    => 'Acara Sekolah',
                'image'       => null,
            ],
            [
                'title'       => 'Kegiatan Pramuka',
                'slug'        => 'kegiatan-pramuka',
                'description' => 'Kegiatan pramuka rutin yang melatih kemandirian, kedisiplinan, dan jiwa kepemimpinan siswa.',
                'category'    => 'Ekstrakurikuler',
                'image'       => null,
            ],
            [
                'title'       => 'Pesantren Kilat Ramadhan',
                'slug'        => 'pesantren-kilat-ramadhan',
                'description' => 'Kegiatan pesantren kilat dalam menyambut Ramadhan, diisi dengan tadarus, ceramah, dan buka puasa bersama.',
                'category'    => 'Keagamaan',
                'image'       => null,
            ],
            [
                'title'       => 'Kunjungan Edukasi ke Museum',
                'slug'        => 'kunjungan-edukasi-museum',
                'description' => 'Kunjungan edukasi ke museum daerah dalam rangka pembelajaran sejarah dan budaya lokal.',
                'category'    => 'Program Pembelajaran',
                'image'       => null,
            ],
        ];

        foreach ($galleries as $data) {
            Gallery::create($data);
        }
    }
}