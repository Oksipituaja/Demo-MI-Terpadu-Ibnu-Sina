<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 – Akses Ditolak | MI Terpadu Ibnu Sina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #F0F4ED;
            --green-dark: #0f2d1a;
            --green-deep: #14532d;
            --green-main: #15803d;
            --gold: #EAB308;
            --gold-dark: #ca8a04;
            --accent: #dc2626;
            --surface: #ffffff;
            --border: rgba(21, 128, 61, 0.12);
            --text: #0f172a;
            --muted: #64748b;
        }

        html,
        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            overflow-x: hidden;
        }

        /* ── Background ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: linear-gradient(135deg, #0f2d1a 0%, #14532d 50%, #15803d 100%);
        }

        .bg-layer::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23EAB308' fill-opacity='0.04'%3E%3Cpath d='M30 0L60 30L30 60L0 30L30 0zM30 10L50 30L30 50L10 30L30 10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size: 60px 60px;
        }

        .glow {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .glow-1 {
            width: 600px;
            height: 600px;
            top: -200px;
            left: -100px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.15) 0%, transparent 65%);
        }

        .glow-2 {
            width: 500px;
            height: 500px;
            bottom: -150px;
            right: -100px;
            background: radial-gradient(circle, rgba(234, 179, 8, 0.1) 0%, transparent 65%);
        }

        /* ── Layout ── */
        .wrapper {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* ── School header ── */
        .school-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 3rem;
            animation: fadeDown 0.5s ease both;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .school-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 0.05em;
        }

        .school-name span {
            color: var(--gold);
        }

        .header-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
        }

        .header-badge {
            font-size: 0.7rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* ── Error icon ── */
        .error-icon-wrap {
            position: relative;
            width: 100px;
            height: 100px;
            margin-bottom: 2rem;
            animation: fadeUp 0.5s 0.1s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon-wrap svg.main-icon {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 20px rgba(220, 38, 38, 0.5));
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                filter: drop-shadow(0 0 16px rgba(220, 38, 38, 0.4));
            }

            50% {
                filter: drop-shadow(0 0 32px rgba(220, 38, 38, 0.7));
            }
        }

        .orbit {
            position: absolute;
            inset: -16px;
            border-radius: 50%;
            border: 1px solid rgba(220, 38, 38, 0.2);
            animation: spin 12s linear infinite;
        }

        .orbit::before {
            content: '';
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent);
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 2.5rem 3rem;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.05);
            animation: fadeUp 0.6s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .error-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(220, 38, 38, 0.08);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 999px;
            padding: 0.3rem 0.875rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.25rem;
        }

        .error-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .2
            }
        }

        .error-title {
            font-size: 1.625rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 0.75rem;
        }

        .error-title em {
            font-style: normal;
            color: var(--accent);
        }

        .error-desc {
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(21, 128, 61, 0.15), transparent);
        }

        .divider-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--green-main);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* ── Info box ── */
        .info-box {
            display: flex;
            gap: 0.75rem;
            text-align: left;
            background: rgba(21, 128, 61, 0.04);
            border: 1px solid rgba(21, 128, 61, 0.1);
            border-left: 3px solid var(--green-main);
            border-radius: 10px;
            padding: 0.875rem 1rem;
            margin-bottom: 1.75rem;
        }

        .info-box-icon {
            flex-shrink: 0;
            color: var(--gold-dark);
            margin-top: 2px;
        }

        .info-box-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .info-box-text {
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── Buttons ── */
        .btn-group {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.25rem;
            border-radius: 10px;
            font-size: 0.825rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--green-main), var(--green-deep));
            color: #fff;
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(21, 128, 61, 0.4);
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1.5px solid rgba(21, 128, 61, 0.15);
        }

        .btn-ghost:hover {
            background: rgba(21, 128, 61, 0.05);
            color: var(--green-deep);
            border-color: rgba(21, 128, 61, 0.3);
        }

        /* ── Footer stamp ── */
        .stamp {
            margin-top: 2rem;
            font-size: 0.68rem;
            color: rgba(255, 255, 255, 0.25);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            animation: fadeUp 0.5s 0.3s ease both;
        }
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

        <div class="error-icon-wrap">
            <div class="orbit"></div>
            <svg class="main-icon" viewBox="0 0 80 88" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 4L8 16V44C8 61.6 22.4 78 40 84C57.6 78 72 61.6 72 44V16L40 4Z" fill="rgba(220,38,38,0.1)"
                    stroke="#dc2626" stroke-width="2" />
                <rect x="29" y="42" width="22" height="16" rx="3" fill="#dc2626" opacity=".9" />
                <path d="M33 42V37C33 33.7 36.7 31 40 31C43.3 31 47 33.7 47 37V42" stroke="#dc2626" stroke-width="2.5"
                    stroke-linecap="round" fill="none" />
                <circle cx="40" cy="50" r="2.5" fill="#fff" opacity=".9" />
            </svg>
        </div>

        <div class="card">
            <div class="error-badge">Error 403 · Forbidden</div>
            <h1 class="error-title">Akses <em>Ditolak</em></h1>
            <p class="error-desc">Anda tidak memiliki izin untuk mengakses halaman ini. Hubungi Super Admin jika Anda
                merasa ini adalah kesalahan.</p>

            <div class="divider">
                <span class="divider-label">
                    <svg width="10" height="10" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M8 0l1.5 5.5L15 7l-5.5 1.5L8 14l-1.5-5.5L1 7l5.5-1.5L8 0z" />
                    </svg>
                    Detail
                </span>
            </div>

            <div class="info-box">
                <svg class="info-box-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <div>
                    <p class="info-box-title">Mengapa ini terjadi?</p>
                    <p class="info-box-text">
                        @if (isset($exception) && $exception->getMessage())
                            {{ $exception->getMessage() }}
                        @else
                            Anda tidak memiliki izin yang cukup untuk mengakses halaman ini. Hubungi Super Admin untuk
                            mendapatkan akses.
                        @endif
                    </p>
                </div>
            </div>

            <div class="btn-group">
                <a href="/admin-panel" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                <a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-ghost">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Ganti Akun
                </a>
            </div>
        </div>

        <p class="stamp">MI Terpadu Ibnu Sina · Restricted Area · 403</p>

        <form id="logout-form" action="/logout" method="POST" style="display:none;">
            <?php echo csrf_field(); ?>
        </form>

    </div>
</body>

</html>
