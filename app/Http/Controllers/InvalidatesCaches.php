<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

trait InvalidatesCaches
{
    /**
     * Invalidate home page cache ketika data berubah
     */
    protected function invalidateHomeCaches(): void
    {
        Cache::forget('home.latest_news');
        Cache::forget('home.random_galleries');
        Cache::forget('home.all_facilities');
        Cache::forget('home.featured_teachers');
        Cache::forget('home.upcoming_agendas');
    }

    /**
     * Invalidate gallery caches
     */
    protected function invalidateGalleryCaches(): void
    {
        Cache::forget('gallery.all_categories');
        Cache::forget('home.random_galleries');
    }

    /**
     * Invalidate about caches
     */
    protected function invalidateAboutCaches(): void
    {
        Cache::forget('about.principal_greeting');
        Cache::forget('about.hero_image');
    }

    /**
     * Invalidate semua cache publik
     */
    protected function invalidateAllPublicCaches(): void
    {
        Cache::flush();
    }
}
