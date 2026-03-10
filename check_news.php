<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== NEWS ARTICLES ===\n";
$news = \App\Models\News::latest('created_at')->get();
echo 'Total: '.$news->count()."\n\n";

foreach ($news as $article) {
    echo "[{$article->id}] {$article->title}\n";
    echo "    Status: {$article->status}\n";
    echo "    Created: {$article->created_at}\n";
    echo '    User: '.($article->user?->name ?? 'Unknown')."\n\n";
}
