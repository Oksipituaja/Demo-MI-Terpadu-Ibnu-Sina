<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class OptimizeCaching
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip header manipulation for binary files and Livewire routes
        if ($response instanceof BinaryFileResponse || $request->is('livewire/*')) {
            return $response;
        }

        // Cache assets tertentu 1 tahun
        if ($request->is('build/*') || $request->is('css/*') || $request->is('js/*') || $request->is('images/*')) {
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
        }
        // Cache halaman publik 1 jam
        elseif ($request->is('/', 'about', 'gallery', 'teachers', 'facilities', 'news', 'agenda', 'prestasi')) {
            $response->header('Cache-Control', 'public, max-age=3600');
            $response->header('ETag', md5($response->getContent()));
        }
        // Cache API 30 menit
        elseif ($request->is('api/*')) {
            $response->header('Cache-Control', 'public, max-age=1800');
        }
        // Disable cache untuk form dinamis
        else {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        }

        // Security headers untuk optimize juga
        $response->header('X-Content-Type-Options', 'nosniff');
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        $response->header('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
