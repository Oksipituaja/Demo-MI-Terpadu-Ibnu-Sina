<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Agenda;
use App\Models\News;
use App\Models\Prestasi;

echo "\n=== DATABASE VERIFICATION ===\n";

echo "\n✓ NEWS (Latest 2):\n";
$news = News::latest()->limit(2)->get();
foreach ($news as $n) {
    echo "  - Title: {$n->title} | Slug: {$n->slug} | Status: {$n->status} | Image: ".($n->featured_image ? 'Yes' : 'None')."\n";
    echo "    Published: {$n->published_at} | Created: {$n->created_at}\n";
}

echo "\n✓ AGENDA (Latest 3):\n";
$agendas = Agenda::latest()->limit(3)->get();
foreach ($agendas as $a) {
    echo "  - Title: {$a->title} | Slug: {$a->slug} | Status: {$a->status}\n";
    echo "    Date: {$a->event_date} | Time: {$a->event_time} | Location: {$a->location}\n";
}

echo "\n✓ PRESTASI (Latest 3):\n";
$prestasis = Prestasi::latest()->limit(3)->get();
foreach ($prestasis as $p) {
    echo "  - Title: {$p->title} | Category: {$p->category} | Status: {$p->status}\n";
    echo "    Achievement Date: {$p->achievement_date} | Image: ".($p->image ? 'Yes' : 'None')."\n";
}

echo "\n=== ALL DATA VERIFIED ===\n\n";
