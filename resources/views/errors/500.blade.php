<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 – Server Error</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0f1117;
            --surface:   #181c27;
            --border:    #252a38;
            --accent:    #f59e0b;
            --accent-dim:#78350f;
            --gold:      #c9a84c;
            --text:      #e8eaf0;
            --muted:     #6b7280;
        }

        html, body { min-height: 100%; background: var(--bg); color: var(--text); font-family: 'DM Sans', sans-serif; overflow: auto; }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(245,158,11,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(245,158,11,.04) 1px, transparent 1px);
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
            background: radial-gradient(circle, rgba(245,158,11,.1) 0%, transparent 70%);
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
        .icon-wrap svg { width: 100%; height: 100%; filter: drop-shadow(0 0 18px rgba(245,158,11,.4)); animation: pulse 2.5s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { filter: drop-shadow(0 0 14px rgba(245,158,11,.35)); } 50% { filter: drop-shadow(0 0 30px rgba(245,158,11,.75)); } }

        /* broken ring - 2 arcs */
        .ring {
            position: absolute; inset: -14px;
            border-radius: 50%;
            border: 1px dashed var(--accent-dim);
            animation: spin 10s linear infinite;
        }
        .ring::before, .ring::after {
            content: '';
            position: absolute; border-radius: 50%;
            width: 8px; height: 8px;
            background: var(--accent);
        }
        .ring::before { top: -4px; left: 50%; transform: translateX(-50%); }
        .ring::after  { bottom: -4px; left: 50%; transform: translateX(-50%); opacity: .4; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* glitch effect on card */
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
            background: rgba(245,158,11,.1);
            border: 1px solid rgba(245,158,11,.3);
            border-radius: 999px;
            padding: .35rem 1rem;
            font-size: .75rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--accent); animation: blink 1s ease-in-out infinite; }
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

        /* error code snippet style */
        .code-box {
            background: #0a0d14;
            border: 1px solid var(--border);
            border-left: 3px solid var(--accent);
            border-radius: 8px;
            padding: .875rem 1.25rem;
            margin-bottom: 2rem;
            text-align: left;
            font-family: 'Courier New', monospace;
            font-size: .8rem;
            color: #6b7280;
        }
        .code-box .line-err { color: var(--accent); }
        .code-box .line-num { color: #2e3347; margin-right: .75rem; user-select: none; }

        .btn-group { display: flex; gap: .75rem; flex-wrap: wrap; justify-content: center; }
        .btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; border-radius: 8px; font-size: .875rem; font-weight: 500; text-decoration: none; transition: all .2s ease; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--accent); color: #0f1117; }
        .btn-primary:hover { background: #fbbf24; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(245,158,11,.35); }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--border); color: var(--text); transform: translateY(-1px); }

        .stamp { margin-top: 2.5rem; font-size: .75rem; color: #2e3347; letter-spacing: .06em; text-transform: uppercase; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="icon-wrap">
        <div class="ring"></div>
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="40" cy="40" r="36" fill="#1e1a0f" stroke="#f59e0b" stroke-width="1.5"/>
            <path d="M40 22v20" stroke="#f59e0b" stroke-width="3" stroke-linecap="round"/>
            <circle cx="40" cy="52" r="3" fill="#f59e0b"/>
            <!-- lightning bolt decoration -->
            <path d="M26 16l-4 8h6l-4 8" stroke="#f59e0b" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity=".3"/>
            <path d="M56 48l-4 8h6l-4 8" stroke="#f59e0b" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity=".3"/>
        </svg>
    </div>

    <div class="card">
        <div class="badge">Error 500 &nbsp;·&nbsp; Server Error</div>

        <h1>Terjadi <em>Kesalahan</em> Server</h1>

        <p>
            Server mengalami masalah saat memproses permintaan Anda.
            Tim teknis akan segera menangani ini.
        </p>

        <div class="divider"><span>Info</span></div>

        <div class="code-box">
            <div><span class="line-num">1</span><span style="color:#4f8ef7">Internal</span> Server Error</div>
            <div class="line-err"><span class="line-num">2</span>⚠ Something went wrong on our end</div>
            <div><span class="line-num">3</span><span style="color:#a78bfa">Status</span>: 500</div>
        </div>

        <div class="info-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div>
                <strong>Apa yang harus dilakukan?</strong>
                <p>Coba muat ulang halaman. Jika masalah berlanjut, hubungi administrator sistem.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="javascript:location.reload()" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                </svg>
                Muat Ulang
            </a>
            <a href="/admin-panel" class="btn btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    <p class="stamp">Admin Panel &nbsp;·&nbsp; Internal Server Error</p>
</div>
</body>
</html>