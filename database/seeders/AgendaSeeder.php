<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Agenda::create([
            'title' => 'Rapat Guru',
            'slug' => 'rapat-guru',
            'description' => 'Rapat koordinasi guru untuk membahas pembelajaran dan pengembangan kurikulum.',
            'event_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'location' => 'Ruang Guru',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Hari Jadi Sekolah',
            'slug' => 'hari-jadi-sekolah',
            'description' => 'Perayaan hari jadi sekolah yang ke-25 dengan berbagai acara meriah.',
            'event_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
            'location' => 'Halaman Sekolah',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Parent Meeting',
            'slug' => 'parent-meeting',
            'description' => 'Pertemuan dengan orang tua siswa untuk membahas perkembangan belajar anak.',
            'event_date' => Carbon::now()->addDays(21)->format('Y-m-d'),
            'location' => 'Aula Sekolah',
            'status' => 'upcoming',
        ]);
    }
}
