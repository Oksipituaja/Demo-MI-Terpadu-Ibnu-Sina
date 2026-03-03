<?php

// Test loading homepage dengan timing breakdown
require_once __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Middleware kernel
$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

// Output timing info
header('X-Debug-Timing: true');
$response->send();
