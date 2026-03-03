<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders
        $this->call([
            UserSeeder::class,
            NewsSeeder::class,
            TeacherSeeder::class,
            GallerySeeder::class,
            AgendaSeeder::class,
            FacilitySeeder::class,
            AboutSeeder::class,
            PrestasiSeeder::class,
        ]);
    }
}
