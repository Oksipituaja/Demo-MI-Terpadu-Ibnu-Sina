<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Teacher::truncate();

        $teachers = [
            [
                'name'    => 'Dr. Bambang Sutrisno, M.Pd',
                'subject' => 'Kepala Sekolah',
                'email'   => 'bambang.sutrisno@mitis.sch.id',
                'phone'   => '081234567890',
            ],
            [
                'name'    => 'Siti Nurhaliza, S.Pd',
                'subject' => 'Guru Kelas I',
                'email'   => 'siti.nurhaliza@mitis.sch.id',
                'phone'   => '081234567891',
            ],
            [
                'name'    => 'Ahmad Wijaya, S.Pd',
                'subject' => 'Matematika',
                'email'   => 'ahmad.wijaya@mitis.sch.id',
                'phone'   => '081234567892',
            ],
            [
                'name'    => 'Dewi Lestari, S.Pd',
                'subject' => 'Bahasa Indonesia',
                'email'   => 'dewi.lestari@mitis.sch.id',
                'phone'   => '081234567893',
            ],
            [
                'name'    => 'Roni Hermawan, S.Pd',
                'subject' => 'Pendidikan Jasmani',
                'email'   => 'roni.hermawan@mitis.sch.id',
                'phone'   => '081234567894',
            ],
            [
                'name'    => 'Rina Kusumawati, S.Pd',
                'subject' => 'Guru Kelas II',
                'email'   => 'rina.kusumawati@mitis.sch.id',
                'phone'   => '081234567895',
            ],
            [
                'name'    => 'Hendra Prasetyo, S.Pd',
                'subject' => 'IPA',
                'email'   => 'hendra.prasetyo@mitis.sch.id',
                'phone'   => '081234567896',
            ],
            [
                'name'    => 'Yuni Astuti, S.Pd',
                'subject' => 'Guru Kelas III',
                'email'   => 'yuni.astuti@mitis.sch.id',
                'phone'   => '081234567897',
            ],
            [
                'name'    => 'Laila Rahmawati, S.Pd.I',
                'subject' => 'Pendidikan Agama Islam',
                'email'   => 'laila.rahmawati@mitis.sch.id',
                'phone'   => '081234567898',
            ],
            [
                'name'    => 'Wahyu Hidayat, S.Pd',
                'subject' => 'Guru Kelas IV',
                'email'   => 'wahyu.hidayat@mitis.sch.id',
                'phone'   => '081234567899',
            ],
        ];

        foreach ($teachers as $data) {
            Teacher::create([
                'name'    => $data['name'],
                'slug'    => Str::slug($data['name']),
                'email'   => $data['email'],
                'phone'   => $data['phone'],
                'subject' => $data['subject'],
                'image'   => null,
            ]);
        }
    }
}