<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupStorage extends Command
{
    protected $signature = 'storage:setup';
    protected $description = 'Setup storage symlink for Railway';

    public function handle()
    {
        $publicStorage = public_path('storage');
        $storagePublic = storage_path('app/public');

        // Remove existing
        if (is_link($publicStorage)) {
            unlink($publicStorage);
        } elseif (is_dir($publicStorage)) {
            // If it's a real directory (volume mounted here), we're done
            $this->info('Volume mounted at public/storage - no symlink needed');
            return 0;
        }

        // Create symlink
        if (!is_link($publicStorage)) {
            symlink($storagePublic, $publicStorage);
            $this->info('Symlink created');
        }

        return 0;
    }
}