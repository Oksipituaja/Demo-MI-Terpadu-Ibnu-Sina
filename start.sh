#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

if [ -L "/app/public/storage" ]; then
    echo "Removing existing symlink..."
    rm /app/public/storage
elif [ -d "/app/public/storage" ]; then
    echo "Removing existing directory..."
    rm -rf /app/public/storage
fi

echo "Running migrations..."
php artisan migrate --force

echo "Creating storage symlink..."
ln -sf /app/storage/app/public /app/public/storage
echo "Symlink created: $(ls -la /app/public/storage)"

echo "Caching..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

chmod -R 775 /app/storage /app/bootstrap/cache

echo "=== Starting PHP Server ==="
php -S 0.0.0.0:$PORT -t public