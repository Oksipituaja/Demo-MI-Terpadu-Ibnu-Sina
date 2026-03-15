<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthTimeout
{
    // Timeout dalam menit — 30 menit tidak aktif akan logout otomatis
    private int $timeout = 30;

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity_time');

            if ($lastActivity && (time() - $lastActivity) > ($this->timeout * 60)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors(['email' => 'Sesi Anda telah berakhir karena tidak aktif. Silakan login kembali.']);
            }

            session(['last_activity_time' => time()]);
        }

        return $next($request);
    }
}