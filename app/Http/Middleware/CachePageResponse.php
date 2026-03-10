<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CachePageResponse
{
    /**
     * Route prefix yang TIDAK boleh di-cache sama sekali
     * karena memerlukan autentikasi atau bersifat dinamis
     */
    private array $noCacheRoutes = [
        '/login',
        '/register',
        '/logout',
        '/forgot-password',
        '/reset-password',
        '/dashboard',
        '/admin-panel',   
        '/admin',
        '/livewire',
    ];

    /**
     * Cache hanya public pages, TIDAK pernah cache protected/auth routes
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (! $request->isMethod('GET') || auth()->check()) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        foreach ($this->noCacheRoutes as $route) {
            if ($path === $route || str_starts_with($path, $route . '/')) {
                return $next($request);
            }
        }

        $fullUrl = $path . ($request->getQueryString() ? '?' . $request->getQueryString() : '');
        $cacheKey = 'page.response.' . md5($fullUrl);

        // Ambil dari cache jika ada
        if (Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);

            return response($cached)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Cache', 'HIT');
        }

        // Generate response dan cache
        $response = $next($request);

        if ($response->isSuccessful() && ! $response->headers->has('X-No-Cache')) {
            Cache::put($cacheKey, $response->getContent(), 3600);
            $response->header('X-Cache', 'MISS');
        }

        return $response;
    }
}