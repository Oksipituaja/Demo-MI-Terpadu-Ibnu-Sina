<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawaban Konsultasi — MI Terpadu Ibnu Sina</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4ed;
            color: #374151;
        }

        .wrapper {
            max-width: 600px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(21,128,61,.10);
        }

        /* ── Header ── */
        .header {
            background: linear-gradient(135deg, #14532d 0%, #15803d 60%, #22c55e 100%);
            padding: 36px 40px 32px;
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }
        .logo-box {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: rgba(255,255,255,.18);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-box span {
            font-size: 13px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -.5px;
        }
        .header-school {
            color: rgba(255,255,255,.85);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.3;
        }
        .header-school small {
            display: block;
            font-size: 10px;
            font-weight: 500;
            color: rgba(255,255,255,.55);
            margin-top: 1px;
        }

        .header-divider {
            height: 1px;
            background: rgba(255,255,255,.12);
            margin-bottom: 18px;
        }

        .header h1 {
            color: #fff;
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -.3px;
        }
        .header p {
            color: rgba(255,255,255,.65);
            font-size: 13px;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.22);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 999px;
            margin-top: 14px;
            letter-spacing: .04em;
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #4ade80;
            flex-shrink: 0;
        }

        /* ── Body ── */
        .body { padding: 32px 40px; }

        .greeting {
            font-size: 15px;
            color: #374151;
            margin-bottom: 24px;
            line-height: 1.7;
        }
        .greeting strong { color: #15803d; font-weight: 700; }

        .section-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: #9ca3af;
            margin-bottom: 10px;
        }

        /* Question box */
        .question-box {
            background: #f8fdf9;
            border-left: 3px solid #d1fae5;
            border-radius: 0 10px 10px 0;
            padding: 14px 16px;
            margin-bottom: 6px;
        }
        .question-subject {
            font-size: 13px;
            font-weight: 700;
            color: #14532d;
            margin-bottom: 6px;
        }
        .question-box p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
        }

        /* Reply box */
        .reply-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #15803d;
            border-radius: 0 12px 12px 0;
            padding: 18px 20px;
            margin-bottom: 6px;
        }
        .reply-box p {
            font-size: 14px;
            color: #14532d;
            line-height: 1.85;
            white-space: pre-line;
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            color: #9ca3af;
            margin-bottom: 28px;
        }
        .meta-icon {
            width: 16px; height: 16px;
            border-radius: 50%;
            background: #dcfce7;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 8px;
            color: #15803d;
        }

        .closing {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.7;
            padding: 16px 18px;
            border-radius: 12px;
            background: #f9fafb;
            border: 1px solid #f3f4f6;
        }
        .closing a {
            color: #15803d;
            font-weight: 700;
            text-decoration: none;
        }

        /* ── Footer ── */
        .footer {
            background: #f0f4ed;
            border-top: 1px solid #e7f0e8;
            padding: 20px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 11.5px;
            color: #9ca3af;
            line-height: 1.7;
        }
        .footer strong { color: #6b7280; }
        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }
        .footer-brand-dot {
            width: 18px; height: 18px;
            border-radius: 5px;
            background: linear-gradient(135deg,#15803d,#22c55e);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 7px;
            font-weight: 900;
            color: #fff;
        }
        .footer-brand-name {
            font-size: 12px;
            font-weight: 700;
            color: #4b5563;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        {{-- ── HEADER ── --}}
        <div class="header">
            <div class="header-top">
                <div class="logo-box"><span>MI</span></div>
                <div class="header-school">
                    MI Terpadu Ibnu Sina
                    <small>Madrasah Ibtidaiyah · Kembang, Jepara</small>
                </div>
            </div>
            <div class="header-divider"></div>
            <h1>Jawaban Konsultasi</h1>
            <p>Pertanyaan Anda telah dijawab oleh tim kami.</p>
            <div class="badge">
                <span class="badge-dot"></span>
                Pertanyaan Anda Sudah Dijawab
            </div>
        </div>

        {{-- ── BODY ── --}}
        <div class="body">

            <p class="greeting">
                Assalamu'alaikum, <strong>{{ $consultation->name }}</strong>.<br>
                Terima kasih telah menghubungi kami. Berikut adalah jawaban atas pertanyaan yang Anda kirimkan:
            </p>

            {{-- Pertanyaan --}}
            <p class="section-label">Pertanyaan Anda</p>
            @if ($consultation->subject)
                <p class="question-subject">{{ $consultation->subject }}</p>
            @endif
            <div class="question-box">
                <p>{{ $consultation->message }}</p>
            </div>
            <div style="margin-bottom:24px;"></div>

            {{-- Jawaban --}}
            <p class="section-label">Jawaban dari Kami</p>
            <div class="reply-box">
                <p>{{ $consultation->reply }}</p>
            </div>

            {{-- Waktu balas --}}
            <div class="meta-row" style="margin-top:10px;">
                <span class="meta-icon">✓</span>
                Dijawab pada:
                <strong style="color:#15803d;">
                    {{ $consultation->replied_at?->locale('id')->isoFormat('dddd, D MMMM YYYY · HH:mm') }} WIB
                </strong>
            </div>

            {{-- Penutup --}}
            <div class="closing">
                Jika Anda masih memiliki pertanyaan lain, silakan kunjungi halaman
                <a href="#">Konsultasi</a> di website kami — kami selalu siap membantu. 🙏<br><br>
                Wassalamu'alaikum warahmatullahi wabarakatuh.
            </div>
        </div>

        {{-- ── FOOTER ── --}}
        <div class="footer">
            <div class="footer-brand">
                <span class="footer-brand-dot">MI</span>
                <span class="footer-brand-name">MI Terpadu Ibnu Sina</span>
            </div>
            <p>
                Email ini dikirim otomatis oleh sistem informasi sekolah.<br>
                Jl. Raya Bangsri - Keling KM.4, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457
            </p>
        </div>

    </div>
</body>

</html>