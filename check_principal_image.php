<?php

require_once __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Get the principal greeting
try {
    $principal = \App\Models\About::where('key', 'principal_greeting')->firstOrFail();

    echo "════════════════════════════════════════════\n";
    echo "✓ PRINCIPAL GREETING DATA DITEMUKAN\n";
    echo "════════════════════════════════════════════\n\n";

    echo "1. TITLE:\n";
    echo '   '.$principal->title."\n\n";

    echo "2. IMAGE PATH (DI DATABASE):\n";
    echo '   '.($principal->image ? $principal->image : 'KOSONG - UPLOAD IMAGE DULU')."\n\n";

    echo "3. FULL IMAGE URL:\n";
    if ($principal->image) {
        $url = 'http://4329_yusuf_hammam.test/storage/'.$principal->image;
        echo '   '.$url."\n\n";

        echo "4. CEK APAKAH FILE ADA:\n";
        $filePath = public_path('storage/'.$principal->image);
        if (file_exists($filePath)) {
            echo '   ✓ FILE EXISTS - '.filesize($filePath)." bytes\n\n";
        } else {
            echo "   ✗ FILE NOT FOUND\n";
            echo '   Expected path: '.$filePath."\n\n";
        }
    } else {
        echo "   ✗ TIDAK ADA IMAGE - UPLOAD IMAGE DI ADMIN PANEL\n\n";
    }

    echo "════════════════════════════════════════════\n";
    echo 'HASIL: ';

    if ($principal->image && file_exists(public_path('storage/'.$principal->image))) {
        echo "✓✓✓ SEMUANYA OK!\n";
        echo "GAMBAR AKAN TAMPIL DI HOMEPAGE SETELAH:\n";
        echo "1. Hard refresh: Ctrl+Shift+R\n";
        echo "2. Atau clear cache browser\n";
    } else {
        echo "✗ ADA MASALAH\n";
        echo "Upload image di admin panel terlebih dahulu!\n";
    }
    echo "════════════════════════════════════════════\n";

} catch (\Exception $e) {
    echo "ERROR: Principal Greeting record tidak ditemukan di database!\n";
    echo 'Pesan: '.$e->getMessage()."\n";
}
