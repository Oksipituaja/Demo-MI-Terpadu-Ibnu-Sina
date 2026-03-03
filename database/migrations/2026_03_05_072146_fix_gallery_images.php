<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update gallery images to use readable filenames
        DB::table('galleries')->where('slug', 'upacara-bendera-hari-senin')->update(['image' => 'gallery/upacara-bendera.jpg']);
        DB::table('galleries')->where('slug', 'kelas-baca-bersama')->update(['image' => 'gallery/kelas-baca.jpg']);
        DB::table('galleries')->where('slug', 'olahraga-antar-kelas')->update(['image' => 'gallery/olahraga.jpg']);
        DB::table('galleries')->where('slug', 'pameran-karya-siswa')->update(['image' => 'gallery/pameran-karya.jpg']);
    }

    public function down(): void
    {
        // Rollback not needed for this fix
    }
};
