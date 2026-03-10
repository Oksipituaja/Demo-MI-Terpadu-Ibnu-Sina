<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Pastikan tidak ada data ongoing yang tersisa
        //    (ganti semua ongoing jadi upcoming sebelum ubah enum)
        DB::table('agendas')
            ->where('status', 'ongoing')
            ->update(['status' => 'upcoming']);

        // 2. Ubah kolom enum — hapus nilai 'ongoing'
        DB::statement("ALTER TABLE agendas MODIFY COLUMN status ENUM('upcoming','completed') DEFAULT 'upcoming'");
    }

    public function down(): void
    {
        // Kembalikan ongoing ke enum jika rollback
        DB::statement("ALTER TABLE agendas MODIFY COLUMN status ENUM('upcoming','ongoing','completed') DEFAULT 'upcoming'");
    }
};