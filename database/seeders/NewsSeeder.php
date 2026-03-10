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
        News::truncate();

        $user = User::first();
        $userId = $user?->id ?? 1;

        $news = [
            [
                'title'        => 'Pembukaan Tahun Ajaran 2024/2025',
                'slug'         => 'pembukaan-tahun-ajaran-2024-2025',
                'excerpt'      => 'Selamat datang di tahun ajaran baru! Seluruh siswa dan guru memulai tahun ajaran 2024/2025 dengan penuh semangat dan harapan.',
                'content'      => '<p>Pembukaan tahun ajaran 2024/2025 dimulai dengan upacara bendera yang meriah di halaman sekolah. Semua siswa baru dan lama hadir bersama para guru dan staf sekolah.</p><p>Kepala sekolah memberikan sambutan yang menginspirasi seluruh peserta didik untuk terus berprestasi, menjaga akhlak, dan meraih mimpi setinggi-tingginya.</p><p>Tahun ajaran ini membawa banyak program baru yang menarik, termasuk program literasi digital dan ekstrakurikuler sains robotika.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title'        => 'Program Literasi Dini Resmi Diluncurkan',
                'slug'         => 'program-literasi-dini-resmi-diluncurkan',
                'excerpt'      => 'SD Bangsri meluncurkan program literasi dini untuk meningkatkan kemampuan membaca dan menulis siswa kelas awal.',
                'content'      => '<p>Program literasi dini adalah inisiatif baru SD Bangsri untuk memastikan semua siswa memiliki keterampilan membaca yang kuat sejak usia dini.</p><p>Program ini melibatkan guru kelas, orang tua, dan komunitas lokal dalam mendukung perkembangan literasi anak-anak.</p><p>Setiap hari Jumat, siswa kelas 1 dan 2 akan mengikuti sesi membaca bersama selama 30 menit sebelum pelajaran dimulai.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title'        => 'Siswa SD Bangsri Raih Prestasi di Kompetisi Sains',
                'slug'         => 'siswa-sd-bangsri-raih-prestasi-kompetisi-sains',
                'excerpt'      => 'Tiga siswa SD Bangsri berhasil meraih medali dalam Kompetisi Sains Tingkat Kabupaten yang diselenggarakan bulan ini.',
                'content'      => '<p>Kompetisi Sains Tingkat Kabupaten yang diikuti oleh lebih dari 50 sekolah berhasil dimenangkan oleh tiga siswa SD Bangsri.</p><p>Mereka berhasil meraih medali emas untuk kategori matematika, medali perak untuk IPA, dan medali perunggu untuk kategori lingkungan hidup.</p><p>Kepala sekolah menyampaikan rasa bangga dan berterima kasih kepada para guru pembimbing atas dedikasi mereka dalam mempersiapkan para siswa.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now()->subDays(4),
            ],
            [
                'title'        => 'Kegiatan Bakti Sosial dalam Rangka HUT RI ke-79',
                'slug'         => 'kegiatan-bakti-sosial-hut-ri-ke-79',
                'excerpt'      => 'Seluruh warga sekolah SD Bangsri menggelar kegiatan bakti sosial berupa pembagian sembako dan bersih-bersih lingkungan.',
                'content'      => '<p>Dalam rangka memperingati Hari Ulang Tahun Republik Indonesia ke-79, SD Bangsri menyelenggarakan kegiatan bakti sosial yang melibatkan seluruh siswa, guru, dan orang tua.</p><p>Kegiatan ini meliputi pembagian sembako kepada warga kurang mampu di sekitar sekolah serta aksi bersih-bersih lingkungan RT setempat.</p><p>Kegiatan ini bertujuan untuk menanamkan rasa kepedulian sosial dan rasa cinta tanah air sejak dini kepada para siswa.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title'        => 'Pengumuman Jadwal Penerimaan Rapor Semester Ganjil',
                'slug'         => 'pengumuman-jadwal-penerimaan-rapor-semester-ganjil',
                'excerpt'      => 'Penerimaan rapor semester ganjil tahun ajaran 2024/2025 akan dilaksanakan pada akhir bulan ini. Orang tua diharap hadir.',
                'content'      => '<p>Sekolah mengumumkan bahwa penerimaan rapor semester ganjil tahun ajaran 2024/2025 akan dilaksanakan pada hari Sabtu, akhir bulan ini pukul 08.00 - 12.00 WIB.</p><p>Seluruh orang tua/wali murid diwajibkan hadir untuk mengambil rapor putra/putrinya. Jika berhalangan hadir, harap menghubungi wali kelas terlebih dahulu.</p><p>Pada kesempatan yang sama, akan diadakan pertemuan singkat antara orang tua dan wali kelas untuk membahas perkembangan belajar siswa.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now()->subDay(),
            ],
            [
                'title'        => 'Pembangunan Perpustakaan Baru Segera Dimulai',
                'slug'         => 'pembangunan-perpustakaan-baru-segera-dimulai',
                'excerpt'      => 'SD Bangsri akan segera memulai pembangunan gedung perpustakaan baru yang lebih modern dan nyaman untuk para siswa.',
                'content'      => '<p>Kabar baik untuk seluruh warga SD Bangsri! Pembangunan gedung perpustakaan baru yang lebih modern dan representatif akan segera dimulai bulan depan.</p><p>Perpustakaan baru ini dirancang dengan ruang baca yang lebih luas, koleksi buku yang lebih lengkap, serta area komputer untuk mendukung literasi digital siswa.</p><p>Dana pembangunan berasal dari program bantuan pemerintah daerah dan sumbangan sukarela dari komite sekolah dan orang tua siswa.</p>',
                'status'       => 'published',
                'published_at' => Carbon::now(),
            ],
        ];

        foreach ($news as $item) {
            News::create(array_merge($item, ['user_id' => $userId]));
        }
    }
}