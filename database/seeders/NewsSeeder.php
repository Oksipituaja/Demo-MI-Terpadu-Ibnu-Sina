<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::first();

        News::create([
            'title' => 'Pembukaan Tahun Ajaran 2024/2025',
            'slug' => 'pembukaan-tahun-ajaran-2024-2025',
            'excerpt' => 'Selamat datang di tahun ajaran baru. Kami berterima kasih atas kepercayaan dan dukungan Anda.',
            'content' => '<p>Pembukaan tahun ajaran 2024/2025 dimulai dengan upacara bendera yang meriah. Semua siswa dan guru hadir untuk memulai tahun ajaran dengan semangat baru.</p><p>Kepala sekolah memberikan sambutan yang menginspirasi semua peserta didik untuk terus berprestasi dan meraih mimpi mereka.</p>',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(5),
            'user_id' => $user->id ?? 1,
        ]);

        News::create([
            'title' => 'Program Literasi Dini Dimulai',
            'slug' => 'program-literasi-dini-dimulai',
            'excerpt' => 'Kami meluncurkan program literasi dini untuk meningkatkan kemampuan membaca siswa kelas awal.',
            'content' => '<p>Program literasi dini adalah inisiatif baru kami untuk memastikan semua siswa memiliki keterampilan membaca yang kuat sejak dini.</p><p>Program ini melibatkan guru, orang tua, dan komunitas lokal dalam mendukung perkembangan literasi anak-anak.</p>',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(3),
            'user_id' => $user->id ?? 1,
        ]);

        News::create([
            'title' => 'Kompetisi Sains Antar Sekolah Berhasil Diselenggarakan',
            'slug' => 'kompetisi-sains-antar-sekolah',
            'excerpt' => 'Siswa kami meraih prestasi gemilang dalam kompetisi sains tingkat kota.',
            'content' => '<p>Kompetisi sains antar sekolah menghadirkan lebih dari 50 peserta dari berbagai sekolah di kota.</p><p>Siswa kami berhasil memenangkan 3 medali emas, 2 medali perak, dan 2 medali perunggu dalam kategori yang berbeda.</p>',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(1),
            'user_id' => $user->id ?? 1,
        ]);
    }
}
