<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class OptimizeCaching
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof BinaryFileResponse || $request->is('livewire/*')) {
            return $response;
        }

        // Cache assets 1 tahun
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
        // Disable cache untuk form dan halaman dinamis
        else {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');
        }

        // ===== Security Headers =====

        // Mencegah browser menebak tipe konten (MIME sniffing attack)
        $response->header('X-Content-Type-Options', 'nosniff');

        // Mencegah halaman ini di-embed dalam iframe di domain lain (clickjacking)
        $response->header('X-Frame-Options', 'SAMEORIGIN');

        // Perlindungan XSS bawaan browser lama
        $response->header('X-XSS-Protection', '1; mode=block');

        // Mengontrol informasi Referer yang dikirim saat berpindah halaman
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Menonaktifkan fitur browser yang tidak dibutuhkan
        $response->header('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        // Memaksa HTTPS — aktifkan ini saat sudah pakai SSL di production
        // $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // Mengontrol resource yang boleh dimuat (inline script, external font, dll)
        // Sesuaikan dengan CDN yang dipakai (Google Fonts, Cloudflare, dll)
        $response->header('Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; " .
            "img-src 'self' data: https:; " .
            "frame-src https://maps.google.com https://www.google.com; " .
            "connect-src 'self'"
        );

        return $response;
    }
}