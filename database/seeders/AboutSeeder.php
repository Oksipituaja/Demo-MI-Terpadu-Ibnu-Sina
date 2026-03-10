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
        About::create([
            'title' => 'Sambutan Kepala Sekolah',
            'principal_name' => 'Dr. Bambang Sutrisno, M.Pd',
            'key' => 'principal_greeting',
            'content' => '<p>Assalamu\'alaikum warahmatullahi wabarakatuh. Saya mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada kami. SD Bangsri berkomitmen untuk memberikan pendidikan berkualitas yang mengintegrasikan nilai-nilai karakter islami modern.</p>

<p>Kami percaya bahwa setiap anak adalah amanah dari Allah SWT yang perlu dikembangkan potensinya secara optimal melalui pendidikan yang holistik. Dengan fasilitas terbaik, kurikulum yang relevan, dan tenaga pendidik yang profesional, kami siap membimbing anak-anak menjadi generasi yang unggul dan berkarakter kuat.</p>

<p>Mari bersama-sama membangun masa depan cerah untuk anak-anak Indonesia. Semoga dedikasi dan komitmen kami menjadi cahaya bagi perjalanan pendidikan mereka.</p>

<p>Wassalamu\'alaikum warahmatullahi wabarakatuh.</p>',
            'image' => null,
        ]);

        About::create([
            'title' => 'Profil Sekolah',
            'key' => 'school_profile',
            'content' => '<h3>Profil Sekolah</h3><p>SD Bangsri adalah sekolah dasar swasta yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan menggabungkan nilai-nilai tradisional dan inovasi modern.</p>',
        ]);

        About::create([
            'title' => 'Misi Kami',
            'key' => 'mission',
            'content' => '<h3>Misi</h3><p>Membangun generasi cerdas, berakhlak mulia, dan mandiri melalui pendidikan yang berkualitas, inovatif, dan berorientasi pada pengembangan potensi siswa.</p>',
        ]);

        About::create([
            'title' => 'Visi Kami',
            'key' => 'vision',
            'content' => '<h3>Visi</h3><p>Menjadi sekolah dasar terdepan yang menghasilkan alumni berkarakter, berkompetensi, dan berkontribusi positif bagi masyarakat dan bangsa.</p>',
        ]);
    }
}
