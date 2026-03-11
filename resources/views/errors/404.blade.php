<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 – Halaman Tidak Ditemukan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0f1117;
            --surface:   #181c27;
            --border:    #252a38;
            --accent:    #4f8ef7;
            --accent-dim:#1a2d5a;
            --gold:      #c9a84c;
            --text:      #e8eaf0;
            --muted:     #6b7280;
        }

        html, body {
            min-height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            overflow: auto;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(79,142,247,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(79,142,247,.04) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridDrift 20s linear infinite;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes gridDrift { 0% { background-position: 0 0; } 100% { background-position: 48px 48px; } }

        body::after {
            content: '';
            position: fixed;
            top: -30%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(79,142,247,.1) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 3rem 2rem;
        }

        /* ── big floating 404 ── */
        .big-number {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(7rem, 20vw, 12rem);
            font-weight: 400;
            line-height: 1;
            letter-spacing: -.02em;
            color: transparent;
            -webkit-text-stroke: 1px rgba(79,142,247,.15);
            position: relative;
            margin-bottom: .5rem;
            animation: floatNum 6s ease-in-out infinite;
            user-select: none;
        }
        .big-number .fill {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #4f8ef7 0%, #a78bfa 60%, #4f8ef7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: .12;
            background-size: 200% 200%;
            animation: gradShift 4s ease infinite;
        }
        @keyframes floatNum { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-14px); } }
        @keyframes gradShift { 0%,100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

        /* ── icon wrap ── */
        .icon-wrap {
            position: relative;
            width: 100px; height: 100px;
            margin-bottom: 2rem;
        }
        .icon-wrap > svg { width: 100%; height: 100%; filter: drop-shadow(0 0 18px rgba(79,142,247,.4)); animation: pulse 3s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { filter: drop-shadow(0 0 14px rgba(79,142,247,.35)); } 50% { filter: drop-shadow(0 0 28px rgba(79,142,247,.7)); } }

        .ring {
            position: absolute; inset: -14px;
            border-radius: 50%;
            border: 1px solid var(--accent-dim);
            animation: spin 14s linear infinite;
        }
        .ring::before {
            content: '';
            position: absolute; top: -4px; left: 50%; transform: translateX(-50%);
            width: 7px; height: 7px; border-radius: 50%;
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
            box-shadow: 0 0 0 1px rgba(255,255,255,.03), 0 24px 64px rgba(0,0,0,.5);
            animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }

        .badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(79,142,247,.1);
            border: 1px solid rgba(79,142,247,.3);
            border-radius: 999px;
            padding: .35rem 1rem;
            font-size: .75rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--accent); animation: blink 1.4s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }

        h1 { font-family: 'DM Serif Display', serif; font-size: clamp(1.8rem, 4vw, 2.4rem); font-weight: 400; line-height: 1.2; margin-bottom: 1rem; }
        h1 em { font-style: italic; color: var(--accent); }
        p { font-size: .95rem; color: var(--muted); line-height: 1.7; margin-bottom: 2rem; }

        .divider { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .divider span { font-size: .7rem; letter-spacing: .12em; text-transform: uppercase; color: var(--muted); }

        .info-row {
            display: flex; gap: .75rem;
            background: rgba(255,255,255,.02);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem; text-align: left;
        }
        .info-row svg { flex-shrink: 0; margin-top: 2px; color: var(--gold); }
        .info-row p { margin: 0; font-size: .85rem; color: var(--muted); }
        .info-row strong { color: var(--text); display: block; margin-bottom: .2rem; font-weight: 500; }

        /* quick links grid */
        .quick-links {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: .6rem; margin-bottom: 2rem;
        }
        .quick-link {
            display: flex; align-items: center; gap: .6rem;
            background: rgba(255,255,255,.02);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: .75rem 1rem;
            text-decoration: none;
            font-size: .82rem; color: var(--muted);
            transition: all .2s ease; text-align: left;
        }
        .quick-link:hover { background: var(--border); color: var(--text); transform: translateY(-1px); }
        .quick-link svg { color: var(--accent); flex-shrink: 0; }

        .btn-group { display: flex; gap: .75rem; flex-wrap: wrap; justify-content: center; }
        .btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; border-radius: 8px; font-size: .875rem; font-weight: 500; text-decoration: none; transition: all .2s ease; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #6fa3ff; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(79,142,247,.35); }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--border); color: var(--text); transform: translateY(-1px); }

        .stamp { margin-top: 2.5rem; margin-bottom: 1rem; font-size: .75rem; color: #2e3347; letter-spacing: .06em; text-transform: uppercase; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="big-number">404<span class="fill">404</span></div>

    <div class="icon-wrap">
        <div class="ring"></div>
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="40" cy="40" r="36" fill="#1a2336" stroke="#4f8ef7" stroke-width="1.5"/>
            <circle cx="36" cy="36" r="11" stroke="#4f8ef7" stroke-width="2" fill="#141c2e"/>
            <path d="M44 44l9 9" stroke="#4f8ef7" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M32 32l8 8M40 32l-8 8" stroke="#4f8ef7" stroke-width="1.8" stroke-linecap="round" opacity=".6"/>
        </svg>
    </div>

    <div class="card">
        <div class="badge">Error 404 &nbsp;·&nbsp; Not Found</div>

        <h1>Halaman <em>Tidak Ditemukan</em></h1>

        <p>
            Halaman yang Anda cari tidak ada, telah dipindahkan,
            atau URL yang dimasukkan tidak sesuai.
        </p>

        <div class="divider"><span>Navigasi Cepat</span></div>

        <div class="quick-links">
            <a href="/admin-panel" class="quick-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                Dashboard
            </a>
            <a href="/admin-panel/news" class="quick-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                News
            </a>
            <a href="/admin-panel/teachers" class="quick-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Teachers
            </a>
            <a href="/admin-panel/galleries" class="quick-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Gallery
            </a>
        </div>

        <div class="info-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div>
                <strong>Kemungkinan penyebab</strong>
                <p>URL salah ketik, halaman telah dihapus, atau link yang sudah tidak aktif.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="/admin-panel" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="javascript:history.back()" class="btn btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Halaman Sebelumnya
            </a>
        </div>
    </div>

    <p class="stamp">Admin Panel &nbsp;·&nbsp; Page Not Found</p>
</div>
</body>
</html>