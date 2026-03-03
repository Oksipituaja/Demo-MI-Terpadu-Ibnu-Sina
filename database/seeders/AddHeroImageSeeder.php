<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AddHeroImageSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah hero_image sudah ada
        if (! About::where('key', 'hero_image')->exists()) {
            About::create([
                'title' => 'Hero Image',
                'key' => 'hero_image',
                'content' => 'Gambar utama yang ditampilkan di homepage',
                'image' => null, // User akan upload melalui admin panel
            ]);
        }
    }
}
