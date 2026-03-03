<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CachePageResponse
{
    /**
     * Cache public pages selama 1 jam untuk super fast loading
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya cache GET requests untuk public pages
        if (! $request->isMethod('GET') || auth()->check()) {
            return $next($request);
        }

        $cacheKey = 'page.response.'.md5($request->getPathInfo());

        // Try get dari cache terlebih dahulu
        if (Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);

            return response($cached)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Cache', 'HIT');
        }

        // Jika tidak ada di cache, generate dan cache
        $response = $next($request);

        if ($response->isSuccessful() && ! $response->headers->has('X-No-Cache')) {
            Cache::put($cacheKey, $response->getContent(), 3600); // 1 jam
            $response->header('X-Cache', 'MISS');
        }

        return $response;
    }
}
