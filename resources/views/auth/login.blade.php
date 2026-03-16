<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'MI Terpadu Ibnu Sina') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green-dark: #0f2d1a; --green-deep: #14532d;
            --green-main: #15803d; --green-mid: #166534;
            --gold: #EAB308; --gold-dark: #ca8a04;
            --cream: #F0F4ED;
            --text-dark: #0f172a; --text-mid: #334155; --text-muted: #64748b;
        }
        html, body { min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        /* Background */
        .bg-pattern { position: fixed; inset: 0; z-index: 0; background: linear-gradient(135deg, #0f2d1a 0%, #14532d 40%, #15803d 70%, #166534 100%); }
        .bg-pattern::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle at 15% 25%, rgba(234,179,8,0.1) 0%, transparent 45%), radial-gradient(circle at 85% 75%, rgba(234,179,8,0.07) 0%, transparent 45%); }
        .bg-pattern::after { content: ''; position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23EAB308' fill-opacity='0.045'%3E%3Cpath d='M30 0L60 30L30 60L0 30L30 0zM30 10L50 30L30 50L10 30L30 10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); background-size: 60px 60px; }
        .orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; }
        .orb-1 { width: 600px; height: 600px; top: -250px; left: -200px; background: radial-gradient(circle, rgba(234,179,8,0.1) 0%, transparent 65%); animation: orbFloat 9s ease-in-out infinite; }
        .orb-2 { width: 450px; height: 450px; bottom: -200px; right: -150px; background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 65%); animation: orbFloat 11s ease-in-out infinite reverse; }
        @keyframes orbFloat { 0%,100%{transform:translate(0,0)} 50%{transform:translate(15px,-15px)} }

        /* Page layout — full height split */
        .page-wrapper {
            position: relative; z-index: 10;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr; /* brand sedikit lebih lebar */
        }

        /* ── LEFT BRAND PANEL ── */
        .brand-panel {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 0;
            position: relative;
        }

        /* Vertical separator */
        .brand-panel::after {
            content: '';
            position: absolute; top: 10%; right: 0; bottom: 10%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(234,179,8,0.25), transparent);
        }

        /* Top section: bismillah + identity */
        .brand-top {
            flex: 0 0 auto;
            padding: 3.5rem 3.5rem 0 4.5rem;
        }

        .bismillah {
            font-family: 'Amiri', serif;
            font-size: 1.6rem;
            color: rgba(234,179,8,0.75);
            direction: rtl;
            margin-bottom: 2.75rem;
            line-height: 1.6;
        }

        .school-identity {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .school-logo {
            width: 88px; height: 88px;
            flex-shrink: 0;
            filter: drop-shadow(0 6px 20px rgba(234,179,8,0.35));
            animation: logoFloat 4s ease-in-out infinite;
        }
        @keyframes logoFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-6px)} }

        .school-text {}
        .school-name-main { font-size: 1.5rem; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -0.02em; }
        .school-name-main span { color: var(--gold); display: block; }
        .school-sub { font-size: 0.72rem; color: rgba(255,255,255,0.45); font-weight: 600; letter-spacing: 0.18em; text-transform: uppercase; margin-top: 0.4rem; }

        /* Middle section: description */
        .brand-mid {
            flex: 1 1 auto;
            padding: 2.5rem 3.5rem 2.5rem 4.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin-bottom: 1.75rem;
        }
        .brand-divider-line { width: 36px; height: 2px; background: linear-gradient(to right, var(--gold), transparent); border-radius: 2px; }
        .brand-divider-dot { width: 5px; height: 5px; border-radius: 50%; background: rgba(234,179,8,0.4); }

        .brand-desc {
            font-size: 1rem;
            color: rgba(255,255,255,0.62);
            line-height: 1.85;
            max-width: 340px;
            margin-bottom: 2.5rem;
        }

        /* Stats row */
        .brand-stats {
            display: flex;
            gap: 0;
        }

        .stat {
            flex: 1;
            display: flex; flex-direction: column;
            padding: 1.25rem 1.25rem 1.25rem 0;
            border-right: 1px solid rgba(255,255,255,0.07);
            gap: 0.3rem;
        }
        .stat:first-child { padding-left: 0; }
        .stat:last-child { border-right: none; }

        .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--gold); line-height: 1; }
        .stat-label { font-size: 0.65rem; color: rgba(255,255,255,0.38); text-transform: uppercase; letter-spacing: 0.12em; font-weight: 600; }

        /* Bottom section: contact/address */
        .brand-bottom {
            flex: 0 0 auto;
            padding: 0 3.5rem 3rem 4.5rem;
        }

        .brand-address {
            display: flex; align-items: flex-start; gap: 0.6rem;
            padding: 1rem 1.25rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
        }
        .brand-address svg { flex-shrink: 0; margin-top: 2px; opacity: 0.5; }
        .brand-address p { font-size: 0.75rem; color: rgba(255,255,255,0.4); line-height: 1.6; }
        .brand-address p strong { color: rgba(255,255,255,0.6); font-weight: 600; display: block; margin-bottom: 0.15rem; }

        /* ── RIGHT FORM PANEL ── */
        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 3rem 3.5rem 3rem 3rem;
            background: rgba(240,244,237,0.97);
            backdrop-filter: blur(24px);
        }

        .form-inner {
            width: 100%; max-width: 380px;
            animation: slideIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
        }
        @keyframes slideIn { from{opacity:0;transform:translateX(16px)} to{opacity:1;transform:translateX(0)} }

        .form-header { margin-bottom: 2rem; }

        .form-eyebrow {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(21,128,61,0.08); border: 1px solid rgba(21,128,61,0.15);
            border-radius: 999px; padding: 0.3rem 0.875rem;
            font-size: 0.7rem; font-weight: 700; color: var(--green-main);
            letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 0.875rem;
        }
        .form-eyebrow::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--green-main); animation: blink 1.4s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }

        .form-title { font-size: 1.7rem; font-weight: 800; color: var(--text-dark); line-height: 1.2; letter-spacing: -0.025em; margin-bottom: 0.375rem; }
        .form-title span { color: var(--green-main); }
        .form-subtitle { font-size: 0.82rem; color: var(--text-muted); line-height: 1.5; }

        /* Alerts */
        .alert-error { background: #fef2f2; border: 1px solid #fecaca; border-left: 3px solid #ef4444; border-radius: 10px; padding: 0.75rem 0.875rem; display: flex; gap: 0.625rem; margin-bottom: 1.25rem; }
        .alert-error-title { font-size: 0.78rem; font-weight: 700; color: #b91c1c; margin-bottom: 0.15rem; }
        .alert-error-list { font-size: 0.72rem; color: #dc2626; list-style: none; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 3px solid var(--green-main); border-radius: 10px; padding: 0.75rem 0.875rem; font-size: 0.78rem; color: var(--green-main); font-weight: 600; margin-bottom: 1.25rem; }

        /* Fields */
        .field-group { margin-bottom: 1.125rem; }
        .field-label { display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-mid); margin-bottom: 0.45rem; }
        .field-wrap { position: relative; }
        .field-icon { position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; transition: color 0.2s; }
        .field-wrap:focus-within .field-icon { color: var(--green-main); }
        .field-input { width: 100%; padding: 0.8rem 1rem 0.8rem 2.6rem; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 11px; font-size: 0.875rem; font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-dark); outline: none; transition: all 0.2s; }
        .field-input::placeholder { color: #94a3b8; }
        .field-input:focus { border-color: var(--green-main); box-shadow: 0 0 0 3.5px rgba(21,128,61,0.08); }
        .field-input.error { border-color: #f87171; }
        .toggle-password { position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #94a3b8; padding: 0; display: flex; align-items: center; transition: color 0.2s; }
        .toggle-password:hover { color: var(--green-main); }
        .field-error { display: flex; align-items: center; gap: 0.3rem; font-size: 0.7rem; color: #ef4444; margin-top: 0.35rem; }

        /* Row */
        .form-row { display: flex; align-items: center; justify-content: space-between; margin: 0.375rem 0 1.375rem; }
        .checkbox-label { display: flex; align-items: center; gap: 0.45rem; font-size: 0.8rem; color: var(--text-muted); cursor: pointer; user-select: none; }
        .checkbox-label input[type="checkbox"] { width: 14px; height: 14px; accent-color: var(--green-main); }
        .back-link { font-size: 0.8rem; font-weight: 600; color: var(--green-main); text-decoration: none; transition: color 0.2s; }
        .back-link:hover { color: var(--green-deep); }

        /* Submit */
        .btn-submit { width: 100%; padding: 0.875rem 1.5rem; background: linear-gradient(135deg, var(--green-main), var(--green-mid)); color: #fff; font-size: 0.9rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; border: none; border-radius: 11px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 4px 16px rgba(21,128,61,0.3); transition: all 0.2s; letter-spacing: 0.01em; }
        .btn-submit:hover { background: linear-gradient(135deg, var(--green-mid), var(--green-deep)); box-shadow: 0 8px 24px rgba(21,128,61,0.42); transform: translateY(-1px); }
        .btn-submit:active { transform: scale(0.98); }
        .btn-submit svg { transition: transform 0.2s; }
        .btn-submit:hover svg { transform: translateX(3px); }

        /* Islamic ornament */
        .islamic-divider { display: flex; align-items: center; gap: 0.75rem; margin: 1.5rem 0 0; opacity: 0.18; }
        .islamic-divider::before, .islamic-divider::after { content: ''; flex: 1; height: 1px; background: var(--green-main); }
        .islamic-divider-inner { display: flex; align-items: center; gap: 0.25rem; }
        .islamic-dot { width: 3.5px; height: 3.5px; border-radius: 50%; background: var(--gold-dark); }
        .islamic-diamond { width: 6px; height: 6px; background: var(--green-main); transform: rotate(45deg); }

        /* Footer */
        .form-footer { margin-top: 1rem; padding: 1rem 0 0; border-top: 1px solid rgba(21,128,61,0.08); text-align: center; }
        .form-footer p { font-size: 0.7rem; color: #94a3b8; line-height: 1.7; }
        .form-footer strong { color: var(--green-main); font-weight: 700; }

        /* Brand panel entrance */
        @keyframes fadeInLeft { from{opacity:0;transform:translateX(-16px)} to{opacity:1;transform:translateX(0)} }
        .brand-top    { animation: fadeInLeft 0.5s 0.05s cubic-bezier(0.22,1,0.36,1) both; }
        .brand-mid    { animation: fadeInLeft 0.5s 0.15s cubic-bezier(0.22,1,0.36,1) both; }
        .brand-bottom { animation: fadeInLeft 0.5s 0.25s cubic-bezier(0.22,1,0.36,1) both; }

        /* Responsive */
        @media (max-width: 900px) {
            .page-wrapper { grid-template-columns: 1fr; }
            .brand-panel { display: none; }
            .form-panel { padding: 2rem 1.5rem; min-height: 100vh; }
            .form-inner { max-width: 100%; }
        }
    </style>
</head>
<body>
<div class="bg-pattern"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<div class="page-wrapper">

    {{-- LEFT: Brand Panel — dibagi 3 section (top/mid/bottom) untuk proporsi lebih baik --}}
    <div class="brand-panel">

        {{-- TOP: Bismillah + Logo + Nama --}}
        <div class="brand-top">
            <p class="bismillah">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيْمِ</p>

            <div class="school-identity">
                <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}"
                     alt="Logo MI Terpadu Ibnu Sina"
                     class="school-logo"
                     onerror="this.style.display='none'">
                <div class="school-text">
                    <h1 class="school-name-main">
                        MI Terpadu
                        <span>Ibnu Sina</span>
                    </h1>
                    <p class="school-sub">Madrasah Ibtidaiyah · Kembang, Jepara</p>
                </div>
            </div>
        </div>

        {{-- MIDDLE: Description + Stats — vertically centered --}}
        <div class="brand-mid">
            <div class="brand-divider">
                <div class="brand-divider-line"></div>
                <div class="brand-divider-dot"></div>
            </div>

            <p class="brand-desc">
                Mendidik generasi Rabbani yang berilmu, berakhlaqul karimah, dan berdaya saing tinggi melalui pendidikan Islam yang berkualitas dan holistik.
            </p>

            <div class="brand-stats">
                <div class="stat">
                    <span class="stat-value">2008</span>
                    <span class="stat-label">Berdiri sejak</span>
                </div>
                <div class="stat" style="padding-left:1.25rem">
                    <span class="stat-value">B</span>
                    <span class="stat-label">Akreditasi</span>
                </div>
                <div class="stat" style="padding-left:1.25rem">
                    <span class="stat-value">MI</span>
                    <span class="stat-label">Jenjang</span>
                </div>
            </div>
        </div>

        {{-- BOTTOM: Address info --}}
        <div class="brand-bottom">
            <div class="brand-address">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <p>
                    <strong>Jl. Raya Bangsri - Keling KM.4</strong>
                    Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457
                </p>
            </div>
        </div>

    </div>

    {{-- RIGHT: Form Panel --}}
    <div class="form-panel">
        <div class="form-inner">

            <div class="form-header">
                <div class="form-eyebrow">Panel Administrasi</div>
                <h2 class="form-title">Selamat <span>Datang</span></h2>
                <p class="form-subtitle">Masuk ke sistem manajemen MI Terpadu Ibnu Sina</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor" style="color:#ef4444;flex-shrink:0;margin-top:2px"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    <div>
                        <p class="alert-error-title">Login gagal</p>
                        <ul class="alert-error-list">@foreach ($errors->all() as $error)<li>• {{ $error }}</li>@endforeach</ul>
                    </div>
                </div>
            @endif
            @if (session('status'))<div class="alert-success">{{ session('status') }}</div>@endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="email">Alamat Email</label>
                    <div class="field-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="admin@mitis.sch.id" class="field-input {{ $errors->has('email') ? 'error' : '' }}">
                    </div>
                    @error('email')<p class="field-error"><svg width="11" height="11" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" class="field-input {{ $errors->has('password') ? 'error' : '' }}" style="padding-right:3rem">
                        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Tampilkan password">
                            <svg id="eye-icon" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')<p class="field-error"><svg width="11" height="11" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>@enderror
                </div>

                <div class="form-row">
                    <label class="checkbox-label"><input type="checkbox" name="remember" id="remember_me"> Ingat saya</label>
                    <a href="{{ route('home') }}" class="back-link">← Ke Beranda</a>
                </div>

                <button type="submit" class="btn-submit">
                    Masuk ke Panel
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </form>

            <div class="islamic-divider">
                <div class="islamic-divider-inner">
                    <div class="islamic-dot"></div>
                    <div class="islamic-diamond"></div>
                    <div class="islamic-dot"></div>
                </div>
            </div>

            <div class="form-footer">
                <p>© {{ date('Y') }} <strong>MI Terpadu Ibnu Sina</strong><br>Kembang, Jepara 59457</p>
            </div>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eye-icon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.innerHTML = isHidden
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
</script>
</body>
</html>