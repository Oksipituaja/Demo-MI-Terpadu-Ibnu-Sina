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
            [
                'key'            => 'principal_greeting',
                'title'          => 'Sambutan Kepala Sekolah',
                'principal_name' => 'Kepala Madrasah',
                'content'        => '<p>Assalamu\'alaikum warahmatullahi wabarakatuh.</p>
<p>Puji syukur kehadirat Allah SWT atas segala nikmat dan karunia-Nya. Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada MIS Terpadu Ibnu Sina.</p>
<p>MIS Terpadu Ibnu Sina berkomitmen untuk mewujudkan generasi muslim yang berilmu, berkarya, taat beribadah, berakhlaqul karimah, terampil, dan unggul dalam prestasi sesuai dengan visi madrasah kami.</p>
<p>Dengan dukungan seluruh tenaga pendidik yang profesional dan fasilitas yang memadai, kami siap membimbing peserta didik menuju masa depan yang cerah dan bermartabat.</p>
<p>Wassalamu\'alaikum warahmatullahi wabarakatuh.</p>',
                'image'          => null,
            ],
            [
                'key'     => 'school_profile',
                'title'   => 'Profil Sekolah',
                'content' => '<p>MIS TERPADU IBNU SINA merupakan salah satu sekolah jenjang MI berstatus Swasta yang berada di wilayah Kec. Kembang, Kab. Jepara, Jawa Tengah.</p>
<p>MIS TERPADU IBNU SINA didirikan pada tanggal 28 Januari 2008 dengan Nomor SK Pendirian Kd.11.20/4/PP.03.2/58/2008 yang berada dalam naungan Kementerian Agama.</p>
<p>Dengan adanya keberadaan MIS TERPADU IBNU SINA, diharapkan dapat memberikan kontribusi dalam mencerdaskan anak bangsa di wilayah Kec. Kembang, Kab. Jepara.</p>',
            ],
            [
                'key'     => 'school_info',
                'title'   => 'Informasi Sekolah',
                'content' => json_encode([
                    'npsn'                => '60712544',
                    'nama_sekolah'        => 'MIS TERPADU IBNU SINA',
                    'naungan'             => 'Kementerian Agama',
                    'jenjang'             => 'MI',
                    'status'              => 'Swasta',
                    'tanggal_berdiri'     => '28 Januari 2008',
                    'sk_pendirian'        => 'Kd.11.20/4/PP.03.2/58/2008',
                    'tanggal_operasional' => '28 Januari 2008',
                    'sk_operasional'      => 'kd.11.20/MI/167/08',
                    'alamat'              => 'Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457',
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            ],
            [
                'key'     => 'vision',
                'title'   => 'Visi Madrasah',
                'content' => '<p>TERWUJUDNYA GENERASI MUSLIM YANG ULAMA\' (BERILMU) DAN AMILIN (BERKARYA) SEHINGGA TA\'AT DAN RAJIN BERIBADAH, BERAKHLAQUL KARIMAH, TERAMPIL DAN UNGGUL DALAM PRESTASI.</p>',
            ],
            [
                'key'     => 'mission',
                'title'   => 'Misi Madrasah',
                'content' => '<ol>
                <li>Menanamkan aqidah shohihah dan ibadah salimah.</li>
                <li>Menanamkan akhlaqul karimah dalam kehidupan sehari-hari.</li>
                <li>Menanamkan jiwa kemandirian sejak dini.</li>
                <li>Menanamkan sikap kreatif dan inovatif dalam menghadapi permasalahan.</li>
                <li>Menyiapkan peserta didik untuk menempuh jenjang pendidikan yang lebih tinggi.</li>
                </ol>',
            ],
        ];

        foreach ($sections as $section) {
            About::updateOrCreate(
                ['key' => $section['key']],  // cari berdasarkan key
                $section                      // update/insert data ini
            );
        }
    }
}