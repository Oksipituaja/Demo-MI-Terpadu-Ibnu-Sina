<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $sections = [
            // ── Hero Beranda (beda dari Hero About) ──────────────────────────
            [
                'key'     => 'home_hero_image',
                'title'   => 'Hero Image Beranda',
                'content' => '',
                'featured_image' => null,
            ],
            // ── Hero Tentang Kami ─────────────────────────────────────────────
            [
                'key'     => 'hero_image',
                'title'   => 'Hero Image',
                'content' => '',
                'featured_image' => null,
            ],
            // ── Sambutan Kepala Sekolah ───────────────────────────────────────
            [
                'key'            => 'principal_greeting',
                'title'          => 'Sambutan Kepala Sekolah',
                'principal_name' => 'Kepala Madrasah',
                'content'        => '<p>Assalamu\'alaikum warahmatullahi wabarakatuh.</p>
<p>Puji syukur kehadirat Allah SWT atas segala nikmat dan karunia-Nya.</p>
<p>MIS Terpadu Ibnu Sina berkomitmen untuk mewujudkan generasi muslim yang berilmu, berkarya, taat beribadah, berakhlaqul karimah, terampil, dan unggul dalam prestasi.</p>
<p>Wassalamu\'alaikum warahmatullahi wabarakatuh.</p>',
                'featured_image' => null,
            ],
            // ── Profil Sekolah ────────────────────────────────────────────────
            [
                'key'     => 'school_profile',
                'title'   => 'Profil Sekolah',
                'content' => '<p>MIS TERPADU IBNU SINA merupakan salah satu sekolah jenjang MI berstatus Swasta yang berada di wilayah Kec. Kembang, Kab. Jepara, Jawa Tengah.</p>',
            ],
            // ── Informasi Sekolah (JSON) ──────────────────────────────────────
            [
                'key'     => 'school_info',
                'title'   => 'Informasi Sekolah',
                'content' => json_encode([
                    'npsn'         => '60712544',
                    'nama_sekolah' => 'MIS TERPADU IBNU SINA',
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            ],
            // ── Visi ──────────────────────────────────────────────────────────
            [
                'key'     => 'vision',
                'title'   => 'Visi Madrasah',
                'content' => '<p>TERWUJUDNYA GENERASI MUSLIM YANG ULAMA\' DAN AMILIN.</p>',
            ],
            // ── Misi ──────────────────────────────────────────────────────────
            [
                'key'     => 'mission',
                'title'   => 'Misi Madrasah',
                'content' => '<ol><li>Menanamkan aqidah shohihah dan ibadah salimah.</li></ol>',
            ],
        ];

        foreach ($sections as $section) {
            About::updateOrCreate(
                ['key' => $section['key']],
                $section
            );
        }
    }
}