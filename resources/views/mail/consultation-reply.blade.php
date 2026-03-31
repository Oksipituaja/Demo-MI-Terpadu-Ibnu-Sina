<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pertanyaan Diterima &#8212; MI Terpadu Ibnu Sina</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #edf2e9;
            color: #374151;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        @media only screen and (max-width: 620px) {
            .email-wrapper {
                width: 100% !important;
                margin: 0 !important;
                border-radius: 0 !important;
            }

            .header-cell {
                padding: 24px 20px 20px !important;
            }

            .body-cell {
                padding: 24px 20px 28px !important;
            }

            .footer-cell {
                padding: 16px 20px !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background-color:#edf2e9;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#edf2e9;">
        <tr>
            <td align="center" style="padding:32px 16px;">

                <table class="email-wrapper" width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 4px 40px rgba(21,128,61,.12);">

                    <!-- HEADER -->
                    <tr>
                        <td class="header-cell"
                            style="background:linear-gradient(135deg,#14532d 0%,#15803d 55%,#22c55e 100%);padding:36px 40px 32px;">

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="60" valign="middle">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td
                                                    style="width:52px;height:52px;background:#ffffff;border-radius:12px;padding:4px;box-shadow:0 2px 10px rgba(0,0,0,.20);">
                                                    <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}"
                                                        alt="MI Terpadu Ibnu Sina" width="44" height="44"
                                                        style="display:block;border-radius:8px;width:44px;height:44px;object-fit:contain;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="middle" style="padding-left:14px;">
                                        <span
                                            style="color:rgba(255,255,255,.92);font-size:14px;font-weight:700;font-family:Arial,sans-serif;display:block;line-height:1.3;">MI
                                            Terpadu Ibnu Sina</span>
                                        <span
                                            style="color:rgba(255,255,255,.58);font-size:11px;font-family:Arial,sans-serif;display:block;margin-top:3px;">Madrasah
                                            Ibtidaiyah &middot; Kembang, Jepara</span>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin:18px 0 22px;">
                                <tr>
                                    <td style="height:1px;background:rgba(255,255,255,.14);font-size:0;line-height:0;">
                                        &nbsp;</td>
                                </tr>
                            </table>

                            <p
                                style="color:#ffffff;font-size:22px;font-weight:800;font-family:Arial,sans-serif;margin:0 0 6px;letter-spacing:-.3px;">
                                Pertanyaan Diterima</p>
                            <p
                                style="color:rgba(255,255,255,.62);font-size:13px;font-family:Arial,sans-serif;margin:0;">
                                Kami telah menerima pertanyaan Anda dan akan segera menjawabnya.</p>

                            <table cellpadding="0" cellspacing="0" border="0" style="margin-top:16px;">
                                <tr>
                                    <td
                                        style="background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.22);border-radius:999px;padding:6px 14px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="width:7px;height:7px;background:#4ade80;border-radius:50%;font-size:0;"
                                                    width="7">&nbsp;</td>
                                                <td
                                                    style="padding-left:7px;color:#ffffff;font-size:11px;font-weight:700;font-family:Arial,sans-serif;letter-spacing:.05em;text-transform:uppercase;">
                                                    Dalam Proses Peninjauan</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td class="body-cell" style="padding:32px 40px 36px;">

                            <p
                                style="font-size:15px;color:#374151;font-family:Arial,sans-serif;line-height:1.75;margin:0 0 28px;">
                                Assalamu&#8217;alaikum, <strong
                                    style="color:#15803d;">{{ $consultation->name }}</strong>.<br>
                                Terima kasih telah menghubungi MI Terpadu Ibnu Sina. Pertanyaan Anda telah kami terima
                                dan akan dijawab dalam <strong>1&ndash;2 hari kerja</strong> ke email ini.
                            </p>

                            <p
                                style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.14em;color:#9ca3af;font-family:Arial,sans-serif;margin:0 0 10px;">
                                Pertanyaan yang Anda Kirimkan</p>

                            @if ($consultation->subject)
                                <p
                                    style="font-size:13px;font-weight:700;color:#14532d;font-family:Arial,sans-serif;margin:0 0 8px;padding-left:4px;">
                                    {{ $consultation->subject }}</p>
                            @endif

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin-bottom:24px;">
                                <tr>
                                    <td
                                        style="background:#f8fdf9;border-left:3px solid #bbf7d0;border-radius:0 10px 10px 0;padding:14px 18px;">
                                        <p
                                            style="font-size:14px;color:#6b7280;font-family:Arial,sans-serif;line-height:1.75;margin:0;">
                                            {{ $consultation->message }}</p>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin-bottom:24px;">
                                <tr>
                                    <td
                                        style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:4px solid #15803d;border-radius:0 14px 14px 0;padding:16px 20px;">
                                        <p
                                            style="font-size:14px;color:#14532d;font-family:Arial,sans-serif;line-height:1.75;margin:0;">
                                            &#128276; <strong>Harap simpan email ini</strong> sebagai bukti bahwa
                                            pertanyaan Anda
                                            telah diterima. Jawaban akan dikirimkan ke alamat email ini secara langsung.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td
                                        style="background:#f9fafb;border:1px solid #f3f4f6;border-radius:12px;padding:18px 20px;">
                                        <p
                                            style="font-size:13px;color:#6b7280;font-family:Arial,sans-serif;line-height:1.75;margin:0;">
                                            Jika Anda memiliki pertanyaan mendesak, silakan hubungi kami langsung
                                            melalui WhatsApp
                                            atau kunjungi halaman
                                            <a href="{{ config('app.url') }}/konsultasi"
                                                style="color:#15803d;font-weight:700;text-decoration:none;">Konsultasi</a>
                                            di website kami.<br><br>
                                            <em>Wassalamu&#8217;alaikum warahmatullahi wabarakatuh.</em>
                                        </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- DIVIDER -->
                    <tr>
                        <td style="padding:0 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="height:1px;background:#e8f5e9;font-size:0;line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td class="footer-cell"
                            style="background:#edf2e9;border-top:1px solid #dde8da;padding:22px 40px;text-align:center;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom:10px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td valign="middle">
                                                    <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}"
                                                        alt="MI Terpadu Ibnu Sina" width="22" height="22"
                                                        style="display:block;border-radius:5px;width:22px;height:22px;">
                                                </td>
                                                <td valign="middle" style="padding-left:8px;">
                                                    <span
                                                        style="font-size:12px;font-weight:700;color:#4b5563;font-family:Arial,sans-serif;">MI
                                                        Terpadu Ibnu Sina</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <p
                                            style="font-size:11px;color:#9ca3af;font-family:Arial,sans-serif;line-height:1.7;margin:0;">
                                            Email ini dikirim otomatis oleh sistem informasi sekolah.<br>
                                            Jl. Raya Bangsri &ndash; Keling KM.4, Desa Jinggotan, Kec. Kembang, Kab.
                                            Jepara 59457
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
