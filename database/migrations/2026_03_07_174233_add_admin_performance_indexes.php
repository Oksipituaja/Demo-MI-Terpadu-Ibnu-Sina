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
        // News indexes
        Schema::table('news', function (Blueprint $table) {
            if (! $this->indexExists('news', 'news_created_at_index')) {
                $table->index('created_at');
            }
            if (! $this->indexExists('news', 'news_status_index')) {
                $table->index('status');
            }
            if (! $this->indexExists('news', 'news_user_id_index')) {
                $table->index('user_id');
            }
        });

        // Gallery indexes
        Schema::table('galleries', function (Blueprint $table) {
            if (! $this->indexExists('galleries', 'galleries_category_index')) {
                $table->index('category');
            }
        });

        // Agenda indexes
        Schema::table('agendas', function (Blueprint $table) {
            if (! $this->indexExists('agendas', 'agendas_event_date_index')) {
                $table->index('event_date');
            }
            if (! $this->indexExists('agendas', 'agendas_status_index')) {
                $table->index('status');
            }
        });

        // Prestasi indexes
        Schema::table('prestasis', function (Blueprint $table) {
            if (! $this->indexExists('prestasis', 'prestasis_status_index')) {
                $table->index('status');
            }
            if (! $this->indexExists('prestasis', 'prestasis_achievement_date_index')) {
                $table->index('achievement_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is safe - only removes if exists
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndexIfExists(['status']);
            $table->dropIndexIfExists(['user_id']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndexIfExists(['category']);
        });

        Schema::table('agendas', function (Blueprint $table) {
            $table->dropIndexIfExists(['event_date']);
            $table->dropIndexIfExists(['status']);
        });

        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropIndexIfExists(['status']);
            $table->dropIndexIfExists(['achievement_date']);
        });
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists(string $table, string $indexName): bool
    {
        $driver = \DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            $result = \DB::selectOne("PRAGMA index_info({$indexName})");
            return $result !== null;
        }

        // MySQL
        return collect(\DB::select("SHOW INDEXES FROM `{$table}` WHERE Key_name = ?", [$indexName]))
            ->count() > 0;
    }
};
