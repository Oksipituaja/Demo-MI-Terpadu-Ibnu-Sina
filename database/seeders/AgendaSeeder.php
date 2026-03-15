<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Agenda::truncate();

        $agendas = [
            [
                'title'       => 'Upacara Hari Pendidikan Nasional',
                'slug'        => 'upacara-hari-pendidikan-nasional',
                'description' => 'Upacara bendera dalam rangka memperingati Hari Pendidikan Nasional yang diikuti seluruh siswa, guru, dan staf MI Terpadu Ibnu Sina.',
                'event_date'  => '2026-05-02',
                'event_time'  => '07:00:00',
                'location'    => 'Lapangan Upacara MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Penerimaan Peserta Didik Baru (PPDB) 2026/2027',
                'slug'        => 'ppdb-2026-2027',
                'description' => 'Pendaftaran siswa baru untuk tahun ajaran 2026/2027. Orang tua dapat mendaftarkan putra-putri secara langsung di sekolah atau melalui sistem online.',
                'event_date'  => '2026-06-01',
                'event_time'  => '08:00:00',
                'location'    => 'Ruang Tata Usaha MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Pertemuan Orang Tua dan Guru (Parent-Teacher Meeting)',
                'slug'        => 'parent-teacher-meeting-semester-2',
                'description' => 'Pertemuan antara orang tua/wali murid dan guru untuk membahas perkembangan belajar siswa semester genap.',
                'event_date'  => '2026-05-15',
                'event_time'  => '09:00:00',
                'location'    => 'Aula MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Pentas Seni Akhir Tahun',
                'slug'        => 'pentas-seni-akhir-tahun-2026',
                'description' => 'Pertunjukan seni tahunan yang menampilkan bakat dan kreativitas siswa dalam bidang tari, musik, drama, dan seni rupa.',
                'event_date'  => '2026-06-20',
                'event_time'  => '13:00:00',
                'location'    => 'Aula MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Classmeeting & Pekan Olahraga Siswa',
                'slug'        => 'classmeeting-pekan-olahraga-2026',
                'description' => 'Kompetisi olahraga dan permainan antar kelas dalam rangka mengisi waktu setelah Ujian Akhir Semester.',
                'event_date'  => '2026-06-10',
                'event_time'  => '07:30:00',
                'location'    => 'Lapangan Olahraga MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Ujian Akhir Semester Genap',
                'slug'        => 'ujian-akhir-semester-genap-2026',
                'description' => 'Pelaksanaan Ujian Akhir Semester (UAS) Genap untuk seluruh siswa kelas 1 hingga kelas 6.',
                'event_date'  => '2026-06-03',
                'event_time'  => '07:30:00',
                'location'    => 'Ruang Kelas MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Wisuda dan Perpisahan Kelas 6',
                'slug'        => 'wisuda-perpisahan-kelas-6-2026',
                'description' => 'Acara wisuda dan perpisahan siswa kelas 6 yang telah menyelesaikan pendidikan dasar di MI Terpadu Ibnu Sina.',
                'event_date'  => '2026-06-25',
                'event_time'  => '09:00:00',
                'location'    => 'Aula MI Terpadu Ibnu Sina',
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Kegiatan Ramadhan & Pesantren Kilat',
                'slug'        => 'pesantren-kilat-ramadhan-2026',
                'description' => 'Kegiatan pesantren kilat dalam rangka menyambut bulan Ramadhan, diisi dengan ceramah, tadarus, dan buka puasa bersama.',
                'event_date'  => '2026-03-15',
                'event_time'  => '08:00:00',
                'location'    => 'Mushola MI Terpadu Ibnu Sina',
                'status'      => 'completed',
            ],
        ];

        foreach ($agendas as $data) {
            Agenda::create($data);
        }
    }
}