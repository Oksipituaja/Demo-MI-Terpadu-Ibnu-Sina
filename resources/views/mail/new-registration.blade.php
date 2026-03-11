<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftar Baru PPDB</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f3f4f6; color: #374151; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #1d4ed8, #4f46e5); padding: 32px 40px; text-align: center; }
        .header h1 { color: #ffffff; font-size: 22px; font-weight: 700; margin-bottom: 4px; }
        .header p { color: #bfdbfe; font-size: 13px; }
        .badge { display: inline-block; background: #fbbf24; color: #92400e; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 999px; margin-top: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .body { padding: 32px 40px; }
        .alert { background: #eff6ff; border-left: 4px solid #2563eb; border-radius: 8px; padding: 14px 16px; margin-bottom: 24px; }
        .alert p { font-size: 14px; color: #1e40af; }
        .alert strong { font-weight: 700; }
        .section-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; margin-bottom: 12px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .info-table tr:nth-child(even) { background: #f9fafb; }
        .info-table td { padding: 10px 14px; font-size: 14px; border-bottom: 1px solid #f3f4f6; }
        .info-table td:first-child { color: #6b7280; font-weight: 600; width: 40%; }
        .info-table td:last-child { color: #111827; font-weight: 500; }
        .cta { text-align: center; margin: 28px 0 8px; }
        .cta a { display: inline-block; background: #2563eb; color: #ffffff; font-size: 14px; font-weight: 700; padding: 12px 28px; border-radius: 10px; text-decoration: none; }
        .footer { background: #f9fafb; border-top: 1px solid #f3f4f6; padding: 20px 40px; text-align: center; }
        .footer p { font-size: 12px; color: #9ca3af; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>🎓 Pendaftar Baru PPDB</h1>
            <p>MI Terpadu Ibnu Sina · Sistem Informasi Sekolah</p>
            <span class="badge">Notifikasi Otomatis</span>
        </div>

        <div class="body">
            <div class="alert">
                <p>Ada <strong>pendaftar baru</strong> yang mengisi formulir PPDB online pada
                <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY · HH:mm') }} WIB</strong>.</p>
            </div>

            <p class="section-title">Data Calon Siswa</p>
            <table class="info-table">
                <tr>
                    <td>Nama Siswa</td>
                    <td>{{ $registration->student_name }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ \Carbon\Carbon::parse($registration->birth_date)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td>Sekolah Asal</td>
                    <td>{{ $registration->current_school ?: '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $registration->address ?: '-' }}</td>
                </tr>
            </table>

            <p class="section-title">Data Orang Tua / Wali</p>
            <table class="info-table">
                <tr>
                    <td>Nama Wali</td>
                    <td>{{ $registration->guardian_name ?: '-' }}</td>
                </tr>
                <tr>
                    <td>Telepon Wali</td>
                    <td>{{ $registration->guardian_phone ?: '-' }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $registration->email }}</td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>{{ $registration->phone }}</td>
                </tr>
            </table>

            <div class="cta">
                <a href="{{ config('app.url') }}/admin-panel/registrations">Lihat di Admin Panel</a>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem <strong>MI Terpadu Ibnu Sina</strong>.<br>
            Jl. Raya Bangsri - Keling KM.4, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457</p>
        </div>
    </div>
</body>
</html>