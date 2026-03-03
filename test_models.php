<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== NEWS ===\n";
$news = \App\Models\News::count();
echo "Total: {$news}\n";

echo "\n=== PRESTASI ===\n";
$prestasi = \App\Models\Prestasi::count();
echo "Total: {$prestasi}\n";
if ($prestasi > 0) {
    $first = \App\Models\Prestasi::first();
    echo "Sample: [{$first->id}] {$first->title}\n";
}

echo "\n=== Other models ===\n";
echo 'Agenda: '.\App\Models\Agenda::count()."\n";
echo 'Gallery: '.\App\Models\Gallery::count()."\n";
echo 'Teachers: '.\App\Models\Teacher::count()."\n";
