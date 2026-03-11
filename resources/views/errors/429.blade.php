<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 – Terlalu Banyak Permintaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0f1117;
            --surface:   #181c27;
            --border:    #252a38;
            --accent:    #10b981;
            --accent-dim:#064e3b;
            --gold:      #c9a84c;
            --text:      #e8eaf0;
            --muted:     #6b7280;
        }

        html, body { min-height: 100%; background: var(--bg); color: var(--text); font-family: 'DM Sans', sans-serif; overflow: auto; }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(16,185,129,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16,185,129,.04) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridDrift 20s linear infinite;
            pointer-events: none;
        }
        @keyframes gridDrift { 0% { background-position: 0 0; } 100% { background-position: 48px 48px; } }

        body::after {
            content: '';
            position: fixed;
            top: -30%; left: 50%; transform: translateX(-50%);
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(16,185,129,.09) 0%, transparent 70%);
            pointer-events: none;
        }

        .wrapper {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 2rem;
        }

        .icon-wrap {
            position: relative;
            width: 110px; height: 110px;
            margin-bottom: 2rem;
        }
        .icon-wrap svg { width: 100%; height: 100%; filter: drop-shadow(0 0 18px rgba(16,185,129,.4)); animation: pulse 2s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { filter: drop-shadow(0 0 12px rgba(16,185,129,.3)); } 50% { filter: drop-shadow(0 0 28px rgba(16,185,129,.7)); } }

        .ring {
            position: absolute; inset: -14px;
            border-radius: 50%;
            border: 1px solid var(--accent-dim);
            animation: spin 8s linear infinite;
        }
        .ring::before {
            content: '';
            position: absolute; top: -4px; left: 50%; transform: translateX(-50%);
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--accent);
        }
        /* second dot opposite */
        .ring::after {
            content: '';
            position: absolute; bottom: -4px; left: 50%; transform: translateX(-50%);
            width: 4px; height: 4px; border-radius: 50%;
            background: var(--accent); opacity: .4;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

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
            background: rgba(16,185,129,.1);
            border: 1px solid rgba(16,185,129,.3);
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

        /* cooldown progress bar */
        .cooldown {
            background: rgba(255,255,255,.02);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 2rem;
        }
        .cooldown-label {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: .75rem;
        }
        .cooldown-label span { font-size: .8rem; color: var(--muted); }
        .cooldown-label strong { font-size: .8rem; color: var(--accent); font-weight: 600; }
        .bar-bg {
            height: 6px; background: var(--border); border-radius: 999px; overflow: hidden;
        }
        .bar-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, var(--accent-dim), var(--accent));
            border-radius: 999px;
            animation: fillBar 60s linear forwards;
        }
        @keyframes fillBar { to { width: 100%; } }

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

        .btn-group { display: flex; gap: .75rem; flex-wrap: wrap; justify-content: center; }
        .btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; border-radius: 8px; font-size: .875rem; font-weight: 500; text-decoration: none; transition: all .2s ease; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #34d399; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(16,185,129,.35); }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--border); color: var(--text); transform: translateY(-1px); }

        /* countdown number */
        #countdown { font-weight: 600; color: var(--accent); }

        .stamp { margin-top: 2.5rem; font-size: .75rem; color: #2e3347; letter-spacing: .06em; text-transform: uppercase; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="icon-wrap">
        <div class="ring"></div>
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="40" cy="40" r="36" fill="#0d1f17" stroke="#10b981" stroke-width="1.5"/>
            <!-- speed lines -->
            <path d="M20 32h12M18 40h16M20 48h12" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" opacity=".35"/>
            <!-- hand / stop symbol -->
            <path d="M36 24v16M40 26v14M44 28v12M48 32v8" stroke="#10b981" stroke-width="2" stroke-linecap="round"/>
            <path d="M36 40c0 0 0 10 8 10s8-10 8-10" fill="#0d2e22" stroke="#10b981" stroke-width="1.5"/>
        </svg>
    </div>

    <div class="card">
        <div class="badge">Error 429 &nbsp;·&nbsp; Too Many Requests</div>

        <h1>Terlalu Banyak <em>Permintaan</em></h1>

        <p>
            Anda telah melakukan terlalu banyak percobaan dalam waktu singkat.
            Tunggu sebentar sebelum mencoba kembali.
        </p>

        <div class="divider"><span>Cooldown</span></div>

        <div class="cooldown">
            <div class="cooldown-label">
                <span>Pemulihan akses</span>
                <strong>Tunggu <span id="countdown">60</span> detik</strong>
            </div>
            <div class="bar-bg"><div class="bar-fill"></div></div>
        </div>

        <div class="info-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div>
                <strong>Mengapa ini terjadi?</strong>
                <p>Sistem mendeteksi terlalu banyak percobaan login atau request berulang. Ini adalah fitur keamanan untuk melindungi akun Anda.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="/admin-panel" class="btn btn-primary" id="dashBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="/login" class="btn btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Halaman Login
            </a>
        </div>
    </div>

    <p class="stamp">Admin Panel &nbsp;·&nbsp; Rate Limited</p>
</div>

<script>
    let seconds = 60;
    const el = document.getElementById('countdown');
    const timer = setInterval(() => {
        seconds--;
        el.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            el.textContent = '0';
            el.closest('.cooldown-label').querySelector('strong').textContent = 'Akses sudah dipulihkan';
        }
    }, 1000);
</script>
</body>
</html>