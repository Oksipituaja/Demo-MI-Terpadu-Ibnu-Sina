<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Index untuk News
        Schema::table('news', function (Blueprint $table) {
            $table->index(['status', 'published_at']);
        });

        // Index untuk Gallery
        Schema::table('galleries', function (Blueprint $table) {
            $table->index('category');
            $table->index('created_at');
        });

        // Index untuk Agenda
        Schema::table('agendas', function (Blueprint $table) {
            $table->index(['status', 'event_date']);
        });

        // Index untuk Teacher
        Schema::table('teachers', function (Blueprint $table) {
            $table->index('created_at');
        });

        // Index untuk About
        Schema::table('abouts', function (Blueprint $table) {
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('agendas', function (Blueprint $table) {
            $table->dropIndex(['status', 'event_date']);
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('abouts', function (Blueprint $table) {
            $table->dropIndex(['key']);
        });
    }
};
