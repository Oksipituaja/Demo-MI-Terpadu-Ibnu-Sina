<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'SD Bangsri School') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Semua styling custom pakai CSS murni agar tidak bergantung pada Tailwind scan */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Background */
        .bg-blob-1 {
            position: fixed; top: -10rem; left: -10rem;
            width: 30rem; height: 30rem;
            background: radial-gradient(circle, rgba(147,197,253,0.5), transparent 70%);
            border-radius: 50%; pointer-events: none; z-index: 0;
        }
        .bg-blob-2 {
            position: fixed; bottom: -10rem; right: -10rem;
            width: 35rem; height: 35rem;
            background: radial-gradient(circle, rgba(165,180,252,0.4), transparent 70%);
            border-radius: 50%; pointer-events: none; z-index: 0;
        }
        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px),
                linear-gradient(to right, rgba(99,102,241,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Wrapper */
        .login-wrapper {
            position: relative; z-index: 10;
            width: 100%; max-width: 420px;
        }

        /* Logo */
        .logo-box {
            width: 64px; height: 64px;
            background: #2563eb;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 20px 40px rgba(37,99,235,0.35);
            margin: 0 auto 1.5rem;
            animation: float 3s ease-in-out infinite;
            cursor: default;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-8px) rotate(-2deg); }
        }

        /* Heading */
        .login-title {
            text-align: center;
            font-size: 1.875rem;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        .login-subtitle span { color: #2563eb; font-weight: 600; }

        /* Card */
        .login-card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 24px;
            padding: 2rem;
            box-shadow:
                0 4px 6px rgba(0,0,0,0.04),
                0 20px 60px rgba(37,99,235,0.08),
                0 0 0 1px rgba(37,99,235,0.04);
        }

        /* Alert error */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            display: flex; gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        .alert-error svg { color: #ef4444; flex-shrink: 0; margin-top: 2px; }
        .alert-error-title { font-size: 0.8125rem; font-weight: 600; color: #b91c1c; }
        .alert-error-list { font-size: 0.75rem; color: #dc2626; margin-top: 0.25rem; list-style: none; }

        /* Form group */
        .form-group { margin-bottom: 1.125rem; }
        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.375rem;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%);
            color: #9ca3af; pointer-events: none;
            transition: color 0.2s;
        }
        .input-wrapper:focus-within .input-icon { color: #2563eb; }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            background: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            color: #111827;
            outline: none;
            transition: all 0.2s;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }
        .form-input.has-error {
            border-color: #f87171;
            background: #fff5f5;
        }
        .form-input.has-error:focus {
            box-shadow: 0 0 0 4px rgba(248,113,113,0.1);
        }
        .input-toggle {
            position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #9ca3af; padding: 0;
            display: flex; align-items: center;
            transition: color 0.2s;
        }
        .input-toggle:hover { color: #2563eb; }
        .field-error {
            display: flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; color: #ef4444;
            margin-top: 0.375rem;
        }

        /* Row remember */
        .form-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin: 0.375rem 0 1.25rem;
        }
        .checkbox-label {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.875rem; color: #4b5563;
            cursor: pointer; user-select: none;
        }
        .checkbox-label input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #2563eb;
            cursor: pointer;
        }
        .back-link {
            font-size: 0.875rem; font-weight: 600;
            color: #2563eb; text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: #1d4ed8; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: #2563eb;
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            box-shadow: 0 8px 20px rgba(37,99,235,0.35);
            transition: all 0.2s;
            letter-spacing: 0.01em;
        }
        .btn-submit:hover {
            background: #1d4ed8;
            box-shadow: 0 12px 28px rgba(37,99,235,0.45);
            transform: translateY(-1px);
        }
        .btn-submit:active { transform: scale(0.98); }
        .btn-submit svg { transition: transform 0.2s; }
        .btn-submit:hover svg { transform: translateX(3px); }

        /* Demo section */
        .demo-section {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }
        .demo-label {
            font-size: 0.75rem; color: #9ca3af;
            font-style: italic; margin-bottom: 0.625rem;
        }
        .demo-code {
            display: inline-block;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            color: #374151;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 1.75rem;
            font-size: 0.6875rem;
            font-weight: 600;
            color: #9ca3af;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Animation entrance */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-wrapper { animation: fadeUp 0.5s ease-out; }
    </style>
</head>
<body>

<div class="bg-blob-1"></div>
<div class="bg-blob-2"></div>
<div class="bg-grid"></div>

<div class="login-wrapper">

    {{-- Logo & Heading --}}
    <div class="logo-box">
        <svg width="36" height="36" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
    </div>

    <h1 class="login-title">Selamat Datang Kembali</h1>
    <p class="login-subtitle">
        Management System <span>{{ config('app.name', 'SD Bangsri School') }}</span>
    </p>

    {{-- Card --}}
    <div class="login-card">

        {{-- Error alert --}}
        @if ($errors->any())
            <div class="alert-error">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="alert-error-title">Ups! Ada kesalahan:</p>
                    <ul class="alert-error-list">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('status'))
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:0.875rem 1rem;margin-bottom:1.25rem;font-size:0.8125rem;color:#15803d;font-weight:600;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                        </svg>
                    </span>
                    <input id="email" name="email" type="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="email"
                        placeholder="nama@sekolah.com"
                        class="form-input {{ $errors->has('email') ? 'has-error' : '' }}">
                </div>
                @error('email')
                    <p class="field-error">
                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input id="password" name="password" type="password"
                        required autocomplete="current-password"
                        placeholder="••••••••"
                        class="form-input {{ $errors->has('password') ? 'has-error' : '' }}"
                        style="padding-right: 3rem;">
                    <button type="button" class="input-toggle" onclick="togglePassword(this)" aria-label="Toggle password visibility">
                        <svg id="eye-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="field-error">
                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember & Back --}}
            <div class="form-row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    Ingat saya
                </label>
                <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                Masuk Ke Panel
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </form>

        {{-- Demo --}}
        <div class="demo-section">
            <p class="demo-label">Akun Demo</p>
            <span class="demo-code">superadmin@school.com / password123</span>
        </div>
    </div>

    <p class="login-footer">&copy; {{ date('Y') }} SD Bangsri School. All Rights Reserved.</p>
</div>

<script>
    function togglePassword(btn) {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.innerHTML = isHidden
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
</script>

</body>
</html>