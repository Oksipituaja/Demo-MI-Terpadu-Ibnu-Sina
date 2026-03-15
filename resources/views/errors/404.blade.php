<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 – Halaman Tidak Ditemukan | MI Terpadu Ibnu Sina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green-dark:#0f2d1a; --green-deep:#14532d; --green-main:#15803d;
            --gold:#EAB308; --gold-dark:#ca8a04;
            --surface:#ffffff; --text:#0f172a; --muted:#64748b;
        }
        html, body { min-height:100vh; font-family:'Plus Jakarta Sans',sans-serif; background:#F0F4ED; }

        /* Background */
        .bg-layer { position:fixed; inset:0; z-index:0; background:linear-gradient(135deg,#0f2d1a 0%,#14532d 50%,#15803d 100%); }
        .bg-layer::after { content:''; position:absolute; inset:0; background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23EAB308' fill-opacity='0.04'%3E%3Cpath d='M30 0L60 30L30 60L0 30L30 0zM30 10L50 30L30 50L10 30L30 10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); background-size:60px 60px; }
        .glow { position:fixed; border-radius:50%; pointer-events:none; z-index:0; }
        .glow-1 { width:600px; height:600px; top:-200px; right:-150px; background:radial-gradient(circle,rgba(234,179,8,0.12) 0%,transparent 60%); }
        .glow-2 { width:500px; height:500px; bottom:-150px; left:-100px; background:radial-gradient(circle,rgba(255,255,255,0.05) 0%,transparent 60%); }

        .wrapper { position:relative; z-index:10; min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:2rem; }

        /* School header */
        .school-header { display:flex; align-items:center; gap:0.75rem; margin-bottom:2rem; animation:fadeDown 0.5s ease both; }
        @keyframes fadeDown { from{opacity:0;transform:translateY(-12px)} to{opacity:1;transform:translateY(0)} }
        @keyframes fadeUp   { from{opacity:0;transform:translateY(16px)}  to{opacity:1;transform:translateY(0)} }
        @keyframes blink    { 0%,100%{opacity:1} 50%{opacity:.2} }
        @keyframes floatNum { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        @keyframes shimmer  { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }

        .school-name { font-size:0.9rem; font-weight:700; color:rgba(255,255,255,0.7); letter-spacing:0.05em; }
        .school-name span { color:var(--gold); }
        .header-dot { width:4px; height:4px; border-radius:50%; background:rgba(255,255,255,0.3); }
        .header-badge { font-size:0.7rem; font-weight:700; color:rgba(255,255,255,0.4); text-transform:uppercase; letter-spacing:0.1em; }

        /* Big 404 number — stronger, more impactful */
        .big-number-wrap {
            position: relative;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.4s 0.05s ease both;
        }

        .big-number {
            font-family: 'Amiri', serif;
            font-size: clamp(7rem, 20vw, 11rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            user-select: none;
            /* Gradient text — jauh lebih impactful dari transparan */
            background: linear-gradient(135deg, rgba(234,179,8,0.9) 0%, rgba(234,179,8,0.5) 40%, rgba(255,255,255,0.15) 70%, rgba(234,179,8,0.3) 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: floatNum 6s ease-in-out infinite, shimmer 5s ease-in-out infinite;
        }

        /* Subtle glow behind number */
        .big-number-wrap::before {
            content: '404';
            position: absolute; inset: 0;
            font-family: 'Amiri', serif;
            font-size: clamp(7rem, 20vw, 11rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            color: transparent;
            -webkit-text-stroke: 1px rgba(234,179,8,0.12);
            filter: blur(8px);
            z-index: -1;
        }

        /* Small icon below number */
        .number-icon {
            position: absolute;
            bottom: -8px; left: 50%;
            transform: translateX(-50%);
            display: flex; align-items: center; gap: 0.4rem;
        }
        .number-icon-line { width: 24px; height: 1px; background: rgba(234,179,8,0.3); }
        .number-icon-dot  { width: 4px; height: 4px; border-radius: 50%; background: rgba(234,179,8,0.5); }

        /* Card */
        .card { background:var(--surface); border:1px solid rgba(255,255,255,0.9); border-radius:20px; padding:2.5rem 2.75rem; max-width:500px; width:100%; text-align:center; box-shadow:0 24px 80px rgba(0,0,0,0.22); animation:fadeUp 0.6s 0.1s cubic-bezier(0.22,1,0.36,1) both; }

        .error-badge { display:inline-flex; align-items:center; gap:0.5rem; background:rgba(21,128,61,0.08); border:1px solid rgba(21,128,61,0.2); border-radius:999px; padding:0.3rem 0.875rem; font-size:0.72rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--green-main); margin-bottom:1.25rem; }
        .error-badge::before { content:''; width:6px; height:6px; border-radius:50%; background:var(--green-main); animation:blink 1.4s ease-in-out infinite; }

        .error-title { font-size:1.625rem; font-weight:800; color:var(--text); line-height:1.2; letter-spacing:-0.02em; margin-bottom:0.625rem; }
        .error-title em { font-style:normal; color:var(--green-main); }
        .error-desc { font-size:0.855rem; color:var(--muted); line-height:1.7; margin-bottom:1.5rem; }

        .divider { display:flex; align-items:center; gap:0.75rem; margin-bottom:1.25rem; }
        .divider::before,.divider::after { content:''; flex:1; height:1px; background:linear-gradient(to right,transparent,rgba(21,128,61,0.12),transparent); }
        .divider-label { font-size:0.68rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--green-main); display:flex; align-items:center; gap:0.4rem; }

        /* Quick links — lebih rich dengan subtitle */
        .quick-links { display:grid; grid-template-columns:1fr 1fr; gap:0.5rem; margin-bottom:1.5rem; }
        .quick-link {
            display:flex; align-items:center; gap:0.75rem;
            background:rgba(21,128,61,0.04); border:1px solid rgba(21,128,61,0.1);
            border-radius:11px; padding:0.75rem 0.875rem;
            text-decoration:none; transition:all 0.2s; text-align:left;
        }
        .quick-link:hover { background:rgba(21,128,61,0.09); border-color:rgba(21,128,61,0.22); transform:translateY(-1px); box-shadow:0 4px 12px rgba(21,128,61,0.1); }
        .quick-link-icon { width:32px; height:32px; border-radius:8px; background:rgba(21,128,61,0.08); display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:background 0.2s; }
        .quick-link:hover .quick-link-icon { background:rgba(21,128,61,0.15); }
        .quick-link-icon svg { color:var(--green-main); }
        .quick-link-text {}
        .quick-link-title { font-size:0.8rem; font-weight:700; color:var(--text); display:block; line-height:1.2; }
        .quick-link-sub { font-size:0.68rem; color:var(--muted); display:block; margin-top:0.1rem; }

        .info-box { display:flex; gap:0.75rem; text-align:left; background:rgba(21,128,61,0.04); border:1px solid rgba(21,128,61,0.1); border-left:3px solid var(--green-main); border-radius:10px; padding:0.875rem 1rem; margin-bottom:1.75rem; }
        .info-box-icon { flex-shrink:0; color:var(--gold-dark); margin-top:2px; }
        .info-box-title { font-size:0.8rem; font-weight:700; color:var(--text); margin-bottom:0.2rem; }
        .info-box-text { font-size:0.78rem; color:var(--muted); line-height:1.6; }

        .btn-group { display:flex; gap:0.75rem; flex-wrap:wrap; justify-content:center; }
        .btn { display:inline-flex; align-items:center; gap:0.5rem; padding:0.7rem 1.25rem; border-radius:10px; font-size:0.825rem; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; transition:all 0.2s; cursor:pointer; border:none; }
        .btn-primary { background:linear-gradient(135deg,var(--green-main),var(--green-deep)); color:#fff; box-shadow:0 4px 12px rgba(21,128,61,0.3); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 8px 20px rgba(21,128,61,0.4); }
        .btn-ghost { background:transparent; color:var(--muted); border:1.5px solid rgba(21,128,61,0.15); }
        .btn-ghost:hover { background:rgba(21,128,61,0.05); color:var(--green-deep); border-color:rgba(21,128,61,0.3); }

        .stamp { margin-top:2rem; font-size:0.68rem; color:rgba(255,255,255,0.25); letter-spacing:0.1em; text-transform:uppercase; animation:fadeUp 0.5s 0.3s ease both; }
    </style>
</head>
<body>
<div class="bg-layer"></div>
<div class="glow glow-1"></div>
<div class="glow glow-2"></div>

<div class="wrapper">

    <div class="school-header">
        <span class="school-name">MI Terpadu <span>Ibnu Sina</span></span>
        <div class="header-dot"></div>
        <span class="header-badge">Admin Panel</span>
    </div>

    {{-- Big 404 — gradient gold, lebih impactful --}}
    <div class="big-number-wrap">
        <div class="big-number">404</div>
        <div class="number-icon">
            <div class="number-icon-line"></div>
            <div class="number-icon-dot"></div>
            <div class="number-icon-line"></div>
        </div>
    </div>

    <div class="card">
        <div class="error-badge">Error 404 · Not Found</div>
        <h1 class="error-title">Halaman <em>Tidak Ditemukan</em></h1>
        <p class="error-desc">Halaman yang Anda cari tidak ada, telah dipindahkan, atau URL yang dimasukkan tidak sesuai.</p>

        <div class="divider">
            <span class="divider-label">
                <svg width="10" height="10" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0l1.5 5.5L15 7l-5.5 1.5L8 14l-1.5-5.5L1 7l5.5-1.5L8 0z"/></svg>
                Navigasi Cepat
            </span>
        </div>

        {{-- Quick links dengan subtitle — lebih rich --}}
        <div class="quick-links">
            <a href="/admin-panel" class="quick-link">
                <div class="quick-link-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div class="quick-link-text">
                    <span class="quick-link-title">Dashboard</span>
                    <span class="quick-link-sub">Halaman utama admin</span>
                </div>
            </a>
            <a href="/admin-panel/news" class="quick-link">
                <div class="quick-link-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="quick-link-text">
                    <span class="quick-link-title">Berita</span>
                    <span class="quick-link-sub">Kelola artikel & berita</span>
                </div>
            </a>
            <a href="/admin-panel/teachers" class="quick-link">
                <div class="quick-link-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div class="quick-link-text">
                    <span class="quick-link-title">Guru</span>
                    <span class="quick-link-sub">Data tenaga pendidik</span>
                </div>
            </a>
            <a href="/admin-panel/galleries" class="quick-link">
                <div class="quick-link-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <div class="quick-link-text">
                    <span class="quick-link-title">Galeri</span>
                    <span class="quick-link-sub">Foto & dokumentasi</span>
                </div>
            </a>
        </div>

        <div class="info-box">
            <svg class="info-box-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>
                <p class="info-box-title">Kemungkinan penyebab</p>
                <p class="info-box-text">URL salah ketik, halaman telah dihapus, atau link yang sudah tidak aktif. Gunakan navigasi di atas untuk berpindah halaman.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="/admin-panel" class="btn btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Ke Dashboard
            </a>
            <a href="javascript:history.back()" class="btn btn-ghost">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>
    </div>

    <p class="stamp">MI Terpadu Ibnu Sina · Page Not Found · 404</p>

</div>
</body>
</html>