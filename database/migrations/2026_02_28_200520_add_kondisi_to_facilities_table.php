<?php
// NAMA FILE: database/migrations/xxxx_add_kondisi_to_facilities_table.php
// Jalankan: php artisan migrate

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Tambah kolom kondisi jika belum ada
            if (!Schema::hasColumn('facilities', 'kondisi')) {
                $table->enum('kondisi', ['tersedia', 'perbaikan', 'belum_ada', 'akan_ada'])
                    ->default('tersedia')
                    ->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('kondisi');
        });
    }
};