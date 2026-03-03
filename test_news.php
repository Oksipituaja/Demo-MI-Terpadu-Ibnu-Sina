<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$count = \App\Models\News::count();
echo "Total news articles in database: {$count}\n";

// Show latest 3
$latest = \App\Models\News::latest('created_at')->take(3)->get();
if ($latest->count() > 0) {
    echo "Latest news:\n";
    foreach ($latest as $article) {
        echo "  [{$article->id}] {$article->title} (Status: {$article->status})\n";
    }
} else {
    echo "No news articles found\n";
}
