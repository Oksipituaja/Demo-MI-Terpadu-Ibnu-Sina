<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert all 'user' role users to 'admin' role
        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: We don't revert to prevent accidental data loss
        // The 'user' role no longer exists in the UserRole enum
    }
};
