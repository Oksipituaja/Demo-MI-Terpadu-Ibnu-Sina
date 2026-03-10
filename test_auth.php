<?php

use App\Models\User;
use App\Enums\UserRole;

require __DIR__ . '/bootstrap/app.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->boot();

$user = User::factory()->create(['role' => UserRole::SuperAdmin, 'is_active' => true]);
echo "User created: " . $user->name . "\n";
echo "Role: " . $user->role->value . "\n";
echo "Is Active: " . ($user->is_active ? 'Yes' : 'No') . "\n";
echo "Can Access Filament: " . ($user->canAccessPanel(null) ? 'Yes' : 'No') . "\n";
?>
