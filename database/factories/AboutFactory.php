<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    protected $model = About::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'principal_name' => $this->faker->name(),
            'content' => $this->faker->paragraphs(3, true),
            'image' => null,
            'key' => $this->faker->unique()->slug(),
        ];
    }

    /**
     * State untuk principal greeting
     */
    public function principalGreeting(): self
    {
        return $this->state([
            'key' => 'principal_greeting',
            'title' => 'Visi & Misi Kepala Sekolah',
            'principal_name' => 'Dr. Bambang Sutrisno, M.Pd',
            'content' => 'Assalamu\'alaikum warahmatullahi wabarakatuh. Saya mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada kami. SD Bangsri berkomitmen untuk memberikan pendidikan berkualitas yang mengintegrasikan nilai-nilai karakter islami modern. Kami percaya bahwa setiap anak adalah amanah dari Allah SWT yang perlu dikembangkan potensinya secara optimal melalui pendidikan yang holistik. Dengan fasilitas terbaik, kurikulum yang relevan, dan tenaga pendidik yang profesional, kami siap membimbing anak-anak menjadi generasi yang unggul dan berkarakter kuat. Mari bersama-sama membangun masa depan cerah untuk anak-anak Indonesia.',
            'image' => null,
        ]);
    }

    /**
     * State untuk hero image
     */
    public function heroImage(): self
    {
        return $this->state([
            'key' => 'hero_image',
            'title' => 'Hero Image',
            'principal_name' => null,
            'content' => 'Gambar utama halaman depan',
            'image' => null,
        ]);
    }
}
