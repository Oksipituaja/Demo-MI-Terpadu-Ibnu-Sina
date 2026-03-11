<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 – Akses Ditolak</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0f1117;
            --surface:   #181c27;
            --border:    #252a38;
            --accent:    #e84545;
            --accent-dim:#7a1f1f;
            --gold:      #c9a84c;
            --text:      #e8eaf0;
            --muted:     #6b7280;
            --shield:    #1e2333;
        }

        html, body {
            min-height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            overflow: auto;
        }

        /* ── animated grid background ── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(232,69,69,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(232,69,69,.04) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridDrift 20s linear infinite;
            pointer-events: none;
        }
        @keyframes gridDrift {
            0%   { background-position: 0 0; }
            100% { background-position: 48px 48px; }
        }

        /* ── radial glow ── */
        body::after {
            content: '';
            position: fixed;
            top: -30%; left: 50%;
            transform: translateX(-50%);
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(232,69,69,.12) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── layout ── */
        .wrapper {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 2rem;
        }

        /* ── shield icon ── */
        .shield-wrap {
            position: relative;
            width: 120px; height: 120px;
            margin-bottom: 2.5rem;
        }
        .shield-wrap svg {
            width: 100%; height: 100%;
            filter: drop-shadow(0 0 20px rgba(232,69,69,.45));
            animation: pulse 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { filter: drop-shadow(0 0 16px rgba(232,69,69,.4)); }
            50%       { filter: drop-shadow(0 0 32px rgba(232,69,69,.75)); }
        }

        /* ── ring ── */
        .ring {
            position: absolute; inset: -16px;
            border-radius: 50%;
            border: 1px solid var(--accent-dim);
            animation: spin 12s linear infinite;
        }
        .ring::before {
            content: '';
            position: absolute; top: -4px; left: 50%; transform: translateX(-50%);
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--accent);
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 3rem 3.5rem;
            max-width: 520px; width: 100%;
            text-align: center;
            box-shadow:
                0 0 0 1px rgba(255,255,255,.03),
                0 24px 64px rgba(0,0,0,.5);
            animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── 403 badge ── */
        .badge-403 {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(232,69,69,.1);
            border: 1px solid rgba(232,69,69,.3);
            border-radius: 999px;
            padding: .35rem 1rem;
            font-size: .75rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .badge-403::before {
            content: '';
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent);
            animation: blink 1.4s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }

        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            font-weight: 400;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: var(--text);
        }
        h1 em {
            font-style: italic;
            color: var(--accent);
        }

        p {
            font-size: .95rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        /* ── divider ── */
        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin-bottom: 2rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: var(--border);
        }
        .divider span {
            font-size: .7rem; letter-spacing: .12em;
            text-transform: uppercase; color: var(--muted);
        }

        /* ── info row ── */
        .info-row {
            display: flex; gap: .75rem;
            background: rgba(255,255,255,.02);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
            text-align: left;
        }
        .info-row svg { flex-shrink: 0; margin-top: 2px; color: var(--gold); }
        .info-row p { margin: 0; font-size: .85rem; color: var(--muted); }
        .info-row strong { color: var(--text); display: block; margin-bottom: .2rem; font-weight: 500; }

        /* ── buttons ── */
        .btn-group { display: flex; gap: .75rem; flex-wrap: wrap; justify-content: center; }

        .btn {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .75rem 1.5rem;
            border-radius: 8px;
            font-size: .875rem; font-weight: 500;
            text-decoration: none;
            transition: all .2s ease;
            cursor: pointer; border: none;
        }
        .btn-primary {
            background: var(--accent);
            color: #fff;
        }
        .btn-primary:hover {
            background: #ff5555;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(232,69,69,.35);
        }
        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover {
            background: var(--border);
            color: var(--text);
            transform: translateY(-1px);
        }

        /* ── footer stamp ── */
        .stamp {
            margin-top: 2.5rem;
            font-size: .75rem;
            color: #2e3347;
            letter-spacing: .06em;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="shield-wrap">
        <div class="ring"></div>
        <svg viewBox="0 0 80 88" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M40 4L8 16V44C8 61.6 22.4 78 40 84C57.6 78 72 61.6 72 44V16L40 4Z"
                  fill="#1e2333" stroke="#e84545" stroke-width="2"/>
            <path d="M40 14L16 24V44C16 57.6 26.8 70.4 40 75.2C53.2 70.4 64 57.6 64 44V24L40 14Z"
                  fill="#2a1a1a" stroke="#7a1f1f" stroke-width="1"/>
            <!-- lock icon -->
            <rect x="29" y="42" width="22" height="16" rx="3" fill="#e84545" opacity=".9"/>
            <path d="M33 42V37C33 33.7 36.7 31 40 31C43.3 31 47 33.7 47 37V42"
                  stroke="#e84545" stroke-width="2.5" stroke-linecap="round" fill="none"/>
            <circle cx="40" cy="50" r="2.5" fill="#fff" opacity=".9"/>
            <line x1="40" y1="52" x2="40" y2="56" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".9"/>
        </svg>
    </div>

    <div class="card">
        <div class="badge-403">Error 403 &nbsp;·&nbsp; Forbidden</div>

        <h1>Akses <em>Ditolak</em></h1>

        <p>
            Halaman ini hanya dapat diakses oleh <strong>Super Admin</strong>.
            Akun Anda tidak memiliki izin yang diperlukan untuk masuk ke area ini.
        </p>

        <div class="divider"><span>Detail</span></div>

        <div class="info-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div>
                <strong>Mengapa ini terjadi?</strong>
                <p>Anda login sebagai Admin biasa. Halaman <em>Management Account</em> hanya tersedia untuk Super Admin yang memiliki akses penuh ke sistem.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="/admin-panel" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="/login" class="btn btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Ganti Akun
            </a>
        </div>
    </div>

    <p class="stamp">Admin Panel &nbsp;·&nbsp; Restricted Area</p>
</div>
</body>
</html>