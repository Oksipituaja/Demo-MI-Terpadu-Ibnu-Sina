<?php
require __DIR__ . '/bootstrap/app.php';

$app = app();
$db = $app->make('db');

// Check About records
$abouts = $db->table('abouts')->get();
echo "Total About records: " . count($abouts) . "\n";

foreach ($abouts as $about) {
    echo "\n---";
    echo "\nKey: " . $about->key;
    echo "\nTitle: " . $about->title;
    echo "\nPrincipal: " . ($about->principal_name ?? 'N/A');
    echo "\nImage: " . ($about->image ?? 'N/A');
}

echo "\n\n";
